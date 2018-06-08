// @flow
export {ZCMap};

import {log as zclog} from "./util";

const _ = require('lodash')


/**
 *
 * @param map
 * @param info
 * @return {ZCMap}
 * @constructor
 *
 *
 * event 'zcmap.active'
 zcmap.mapEle.on('zcmap.active', function (e, id, last_id) {
            eleAddr.html(this.plots[id]['addr'] || '')
     }
 */

function ZCMap(map, info) {
    var me = this;

    /** @type {jQuery} */
    me.mapEle = null;
    /** @type {Raphael} */
    me.paper = null;


    me.mode = map.mode || 'all'; // 'single' 'cumulative', or 'all_not_inited' (初次进入all，需要先进入all_not_inited，确保所有plots显示到地图上)
    me._direction = map.direction || 'ltr'; // 'ltr', 'rtl'
    const plotsFirstShow = me._resetData(map);

    // todo 切换时的显示模式 目前只支持高亮一个plot而其它不显示
    me.updateTimer = null;
    me.config = {
        plotSize: map.config.plotSize || 10,
        areaColor: "#FAFAF3",
        plotDefaultStyle: {
            fill: map.config.plotColor || "#004a9b",
        },
    };
    me.mapName = map.config.mapName;


    /** @type {jQuery} */
    me.addrEle = null;
    /** @type {string} */
    me.infoEle = null;
    me.infoVue = null;
    me.infoData = null;
    me.infoKeys = null;

    if (info) {
        me._initInfo(info);
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
                    target: '_blank',
                    eventHandlers: {
                        mouseover: map.mouseoverCallback
                    },
                    attrs: me.config.plotDefaultStyle,
                },
            },
            plots: plotsFirstShow,
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

ZCMap.prototype.resetDataAndShow = function (mapData) {
    const to_del_ids = this.plot_ids_on_map;
    const newPlots = this._resetData(mapData);
    this._ActiveOrChangePlot({
            active: null,
            change: {
                toShowIDs: this.plot_ids_on_map,
                newPlots: newPlots,
                deletePlotIDs: to_del_ids
            }
        }
    )
}
ZCMap.prototype._resetData = function (mapData) {
    /** @type {number[]} */
    this.all_plots_ids = mapData.plotsIDs;
    this.plots = mapData.plots;
    /** @type {number} */
    this.lastActivePlotID = null;

    let plotsFirstShow;

    if (this.mode === 'all') {
        /** @type {number[]} */
        this.plot_ids_on_map = mapData.plotsIDs;
        plotsFirstShow = this.plots;
    } else {
        this.plot_ids_on_map = [
            this._direction === 'ltr' ? mapData.plotsIDs[0] : mapData.plotsIDs[-1]
        ];
        plotsFirstShow = mapData.plots[this.plot_ids_on_map[0]];
    }

    return plotsFirstShow;

}

ZCMap.prototype._initInfo = function (info) {
    var me = this;

    me.infoEle = info.ele;
    me.addrEle = $(info.addrEle);

    let infoData = info.data;
    for (let id in infoData) {
        if (infoData[id]['intro'])
            infoData[id]['intro'] = zc.content.renderMD(infoData[id]['intro'])
    }


    me.infoData = infoData;
    me.infoKeys = info.keys;
    if (info.infoSwipeBox) {
        $(info.infoSwipeBox).swipe({
            swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                if (direction == 'ltr') {
                    me.lightRight();
                } else if (direction == 'rtl') {
                    me.lightLeft();
                }
            },
            //Default is 75px,
            threshold: 40
        });

    }

}

ZCMap.debug = false;
ZCMap.log = function () {
    ZCMap.debug && zclog.apply(null, arguments)
}
ZCMap.prototype.enterLeft = function () {
    this._direction = 'ltr';
    ZCMap.log('[map] start direction ltr')
}
ZCMap.prototype.enterRight = function () {
    this._direction = 'rtl';
    ZCMap.log('[map] start direction rtl')
}
ZCMap.prototype.enterMode = function (mode) {
    if (mode === 'all')
        this.mode = 'all_not_inited';
    else if (mode === 'single' || mode === 'cumulative')
        this.mode = mode;
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
        if (nextActivePlotID === this.lastActivePlotID && !change) return;
        ZCMap.log('[map] to active plot :', nextActivePlotID, '; deactive:', this.lastActivePlotID)

        if (newPlots && newPlots[nextActivePlotID]) {
            newPlots[nextActivePlotID]['attrs'] = {fill: 'red'}
        } else {
            mapOptions.plots[nextActivePlotID] = {attrs: {fill: "red"},};
        }

        mapOptions.plots[this.lastActivePlotID] = {attrs: this.config.plotDefaultStyle};
    }


    // for mapael v2   新版本的api不一样
//                    var opt = {
//                        mapOptions: mapOptions,
//                        newPlots: newPlots,
//                        deletePlotIDs: deletePlotIDs,
//                    };
    this.mapEle.trigger('update', [{mapOptions: mapOptions, newPlots: newPlots, deletePlotKeys: deletePlotIDs}]);


    if (!isNaN(nextActivePlotID)) {

        this.mapEle.trigger('zcmap.active', [nextActivePlotID, this.lastActivePlotID]);

        this.lastActivePlotID = nextActivePlotID;
    }

    if (change) {
        this.plot_ids_on_map = change.toShowIDs;
    }

}


/**
 * ligth single plot and auto computer where plots needd to changes
 * @param {number} nextPlotID it can be <0  representing something like quotes, not in this.all_plots_ids
 * @private
 */
ZCMap.prototype._lightSinglePlotAndAutoChange = function (nextPlotID: number) {

    const all = this.all_plots_ids, me = this;
    let to_show_ids, index;

    index = all.indexOf(nextPlotID);
    if (index < 0) {
        return;
    }

    switch (this.mode) {
        case  'cumulative':
            to_show_ids = this._direction === 'rtl' ? all.slice(index) : all.slice(0, index + 1);
            break;
        case 'single':
            to_show_ids = [nextPlotID];
            break;
        case 'all_not_inited':
            this.mode = 'all';
            to_show_ids = all;
            break;
    }


    const to_add_ids = _.difference(to_show_ids, me.plot_ids_on_map),
        to_del_ids = _.difference(me.plot_ids_on_map, to_show_ids);

    ZCMap.log('[map] from: ', this.plot_ids_on_map)
    ZCMap.log('      to ', to_show_ids)
    ZCMap.log('      add ', to_add_ids)
    ZCMap.log('      del ', to_del_ids)
    ZCMap.log('      active ', nextPlotID)

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

    this.addrEle.html(infoData[id]['addr']);

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

    if (this.mode == 'all') {

        this._ActiveOrChangePlot({active: nextActivePlotID})

    } else {

        this._lightSinglePlotAndAutoChange(nextActivePlotID)

    }
}

// light: 点燃；点火
ZCMap.prototype.lightLeft = function () {
    this.update(this.leftID());
}
ZCMap.prototype.lightRight = function () {
    this.update(this.rightID());
}
ZCMap.prototype.leftID = function () {
    return this.all_plots_ids[parseInt(this.all_plots_ids.indexOf(this.lastActivePlotID)) - 1];
}
ZCMap.prototype.rightID = function () {
    var plus = this.all_plots_ids.indexOf(this.lastActivePlotID) + 1;
    return this.all_plots_ids[plus == this.lastActivePlotID.length ? 0 : plus];
}
