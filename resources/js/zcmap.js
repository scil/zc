// @flow
export {ZCMap};

import {log as zclog} from "./util";

const _ = require('lodash')

function ZCMap(map, info) {
    var me = this;

    /** @type {jQuery} */
    me.mapEle = null;
    /** @type {Raphael} */
    me.paper = null;

    // todo
    /** @deprecated */
    me.addrEle = null;
    /** @type {string} */
    me.infoEle = null;

    /** @type {number[]} */
    me.all_plots_ids = map.plotsIDs;
    me.plots = map.plots;
    /** @type {number[]} */
    me.plots_on_map = map.plotsIDs;
    /** @type {number} */
    me.lastActivePlot = null; // 不可设置为-1,-2之类，因为这些数会用来代表slides前面的quote

    me._mode_direction = null; // null, 'left', 'right'
    // todo 切换时的显示模式 目前只支持高亮一个plot而其它不显示
    me.mode = 'single'; // 'stepin'
    me.updateTimer = null;
    me.config = {
        plotSize: map.config.plotSize || 10,
        areaColor: "#FAFAF3",
        plotDefaultStyle: {
            fill: map.config.plotColor || "#004a9b",
        },
    };
    me.mapNmae = map.config.mapName;


    me.infoVue = null;
    if (info) {
        me.infoEle = info.ele;

        let infoKeys = [], infoData = info.data;
        for (let id1 in infoData) {
            if (infoData[id1]['intro']) {
                for (let id in infoData) {
                    infoData[id]['intro'] = zc.content.renderMD(infoData[id]['intro'])
                }
            }
            for (var k in infoData[id1]) {
                infoKeys.push(k);
            }
            // for 循环只需要找出一个元素 确定里面的keys
            break
        }
        me.infoData = infoData;
        me.infoKeys = infoKeys;
    }
    if (info.infoSwipeBox) {
        $(info.infoSwipeBox).swipe({
            swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                if (direction == 'left') {
                    me.lightRight();
                } else if (direction == 'right') {
                    me.lightLeft();
                }
            },
            //Default is 75px,
            threshold: 40
        });

    }

    me.mapEle = $(map.ele).mapael(
        {
            map: {
//                            name: "world_countries",
                name: me.mapName || 'world',
                zoom: {
                    enabled: true,
                    maxLevel: 40,
                    zoomInCssClass: 'hidden',
                    zoomOutCssClass: 'hidden',
                },
                //tooltip: {target:'#person-map-tooltip'},
                afterInit: function ($self, paper, areas, plots, options) {
                    me.paper = paper;
                },
                defaultArea: {
                    // 通过格式消灭国界
                    attrs: {
                        fill: me.config.areaColor
                        , stroke: me.config.areaColor
                    }
                    , attrsHover: {
                        fill: me.config.areaColor
                    },
                },
                // Set default plots and areas style
                defaultPlot: {
                    size: me.config.plotSize,
                    eventHandlers: {
                        mouseover: map.mouseoverCallback
                    },
                    attrs: me.config.plotDefaultStyle,
                },
            },
            plots: me.plots,
        }
    );


    me.mapEle.on('afterZoom', function () {
        var level = $(this).data('mapael').zoomData.zoomLevel;
        var b = Math.pow(0.95, level);
        ZCMap.log('[map] zoom:', level, '; plot size will be ', me.config.plotSize * b);
        $(this).trigger('update', [{
            mapOptions: {
                map: {
                    defaultPlot: {
                        size: me.config.plotSize * b,
                    }
                }
            }
        }])
    })


    if (map.autoLightFirst) {
        me.update(me.all_plots_ids[0]);
    }

    return me;

}

ZCMap.debug = false;
ZCMap.log = function () {
    ZCMap.debug && zclog.apply(null, arguments)
}
ZCMap.prototype.enterLeft = function () {
    this._mode_direction = 'left';
    ZCMap.log('[map] start direction left')
}
ZCMap.prototype.enterRight = function () {
    this._mode_direction = 'right';
    ZCMap.log('[map] start direction right')
}
ZCMap.prototype.exitDirection = function () {
    this._mode_direction = null;
    ZCMap.log('[map] end direction')
}
ZCMap.prototype.inDirection = function () {
    return this._mode_direction;
}

// 可高亮某个plot 还可增加、可删除；此函数主要用来高亮，因为增加删除只需要用mapael的update就行
ZCMap.prototype._ActiveOrChangePlot = function (opt) {

    const change = opt.change || null;

    let newPlots = change && change.newPlots || {};
    let deletePlotIDs = change && change.deletePlotIDs || [];
    let mapOptions = {plots: {}};

    let nextActivePlotID = parseInt(opt.active);
    nextActivePlotID = this.plots[nextActivePlotID] ? nextActivePlotID : NaN;
    if (!isNaN(nextActivePlotID)) {
        if (nextActivePlotID === this.lastActivePlot && !change) return;
        ZCMap.log('[map] to active plot :', nextActivePlotID, '; deactive:', this.lastActivePlot)

        if (newPlots && newPlots[nextActivePlotID]) {
            newPlots[nextActivePlotID]['attrs'] = {fill: 'red'}
        } else {
            mapOptions.plots[nextActivePlotID] = {attrs: {fill: "red"},};
        }

        mapOptions.plots[this.lastActivePlot] = {attrs: this.config.plotDefaultStyle};
    }


    // for mapael v2   新版本的api不一样
//                    var opt = {
//                        mapOptions: mapOptions,
//                        newPlots: newPlots,
//                        deletePlotIDs: deletePlotIDs,
//                    };
    this.mapEle.trigger('update', [{mapOptions: mapOptions, newPlots: newPlots, deletePlotKeys: deletePlotIDs}]);


    if (!isNaN(nextActivePlotID)) {
        this.eleAddr && this.eleAddr.html(this.plots[nextActivePlotID]['addr'] || '')
        this.lastActivePlot = nextActivePlotID;
    }

    if (change) {
        this.plots_on_map = change.toShowIDs;
    }

}


/**
 * ligth single plot and auto computer where plots needd to changes
 * @param {number} nextPlotID it can be <0  representing something like quotes, not in this.all_plots_ids
 * @private
 */
ZCMap.prototype._lightSinglePlotAndAutoChange = function (nextPlotID: number) {

    const all = this.all_plots_ids, me = this;
    let to_show_ids;

    if (nextPlotID >= 0) {
        to_show_ids = this._mode_direction === 'right' ? all.slice(all.indexOf(nextPlotID)) : all.slice(0, nextPlotID + 1);
    }
    else {
        to_show_ids = all;
    }


    const to_add_ids = _.difference(to_show_ids, me.plots_on_map),
        to_del_ids = _.difference(me.plots_on_map, to_show_ids);

    ZCMap.log('[map] on  ', this.plots_on_map)
    ZCMap.log('      show ', to_show_ids)
    ZCMap.log('      add ', to_add_ids)
    ZCMap.log('      del ', to_del_ids)

    var to_add = {};
    _.each(to_add_ids, function (id) {
        to_add[id] = me.plots[id];
    })

    this._ActiveOrChangePlot({
            active: nextPlotID,
            change: {
                toShowIDs: to_show_ids,
                newPlots: to_add,
                deletePlotIDs: to_del_ids
            }
        }
    )


}

/**
 *
 * @param {number} id  can be <0
 * @private
 */
ZCMap.prototype._updateInfo = function (id: number) {
    if (!this.infoEle) {
        return;
    }

    var infoData = this.infoData;
    if (!infoData[id]) {
        ZCMap.log('[map info] not found id ', id, ' in ', infoData);
        return;
    }

    if (!this.infoVue) {
        var data = {};

        for (var ki in this.infoKeys) {
            data[this.infoKeys[ki]] = infoData[id][this.infoKeys[ki]];
        }
        this.infoVue = new Vue({
            el: this.infoEle,
            data: data,
        })
    } else {
        for (var ki in this.infoKeys) {
            this.infoVue[this.infoKeys[ki]] = infoData[id][this.infoKeys[ki]];
        }
    }

}

/**
 * update info and light next plot
 * @param nextActivePlotID
 */
ZCMap.prototype.update = function (nextActivePlotID: number | string) {

    nextActivePlotID = parseInt(nextActivePlotID);

    if (isNaN(nextActivePlotID)) return;

    this._updateInfo(nextActivePlotID);

    if (this.inDirection()) {
        if (nextActivePlotID < 0) { // 注意：滑入 quote之类的slide，则退出direction
            this.exitDirection();
        }

        this._lightSinglePlotAndAutoChange(nextActivePlotID)

    } else {
        this._ActiveOrChangePlot({active: nextActivePlotID})
    }
}

// light: 点燃；点火
ZCMap.prototype.lightLeft = function () {
    var id = this.all_plots_ids[parseInt(this.all_plots_ids.indexOf(this.lastActivePlot)) - 1];
    this.update(id);
}
ZCMap.prototype.lightRight = function () {
    var plus = this.all_plots_ids.indexOf(this.lastActivePlot) + 1;
    var id = this.all_plots_ids[plus == this.lastActivePlot.length ? 0 : plus];
    this.update(id);
}
