export {ZCMap};
import {log as zclog} from "./util";

function ZCMap(map, info) {
    var me = this;
    me.mapEle = null;
    me.addrEle = null;
    me.all_plots_ids = map.plotsIDs;
    me.plots = map.plots;
    me.plots_on_map = map.plotsIDs;
    me._mode_status = null;
    // todo 切换时的显示模式 目前只支持高亮一个plot而其它不显示
    me.mode = 'single'; // 'stepin'
    me.lastActivePlot = null; // 不可设置为-1,-2之类，因为这些数会用来代表slides前面的quote
    me.updateTimer = null;
    me.config = {
        plotSize: map.config.plotSize || 10,
        areaColor: "#FAFAF3",
        plotDefaultStyle: {
            fill: map.config.plotColor || "#004a9b",
        },
    };
    me.mapNmae = map.config.mapName;


    me._infoVue = null;
    if (info) {
        me._infoEle = info.ele;

        var infoKeys = [], infoData = info.data;
        for (var id1 in infoData) {
            if (infoData[id1]['intro']) {
                for (var id in infoData) {
                    infoData[id]['intro'] = zc.content.renderMD(infoData[id]['intro'])
                }
            }
            for (var k in infoData[id1]) {
                infoKeys.push(k);
            }
            // for 循环只需要找出一个元素 确定里面的keys
            break
        }
        me._infoData = infoData;
        me._infoKeys = infoKeys;
    }
    if (info.infoSwipeBox) {
        $(info.infoSwipeBox).swipe({
            swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                if (direction == 'left') {
                    me.lightDown();
                } else if (direction == 'right') {
                    me.lightUp();
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
        zclog('[map] zoom:', level, '; plot size will be ', me.config.plotSize * b);
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
    if (ZCMap.debug)
        window['console'] && console.log.apply(null, arguments)
}
ZCMap.prototype.enterLeft = function () {
    this._mode_status = 'left';
    zclog('[map] start special mode', 'left')
}
ZCMap.prototype.enterRight = function () {
    this._mode_status = 'right';
    zclog('[map] start special mode', 'right')
}
ZCMap.prototype.exitMode = function () {
    this._mode_status = null;
    ZCMap.log('end special mode')
}
ZCMap.prototype.inMode = function () {
    return this._mode_status;
}

// 可高亮某个plot 还可增加、可删除；此函数主要用来高亮，因为增加删除只需要用mapael的update就行
ZCMap.prototype._ActiveOrChangePlot = function (opt) {

    var nextActivePlotID = isNaN(parseInt(opt.active)) ? NaN : parseInt(opt.active);
    var change = opt.change || null;
    var newPlots = change && change.newPlots || {};
    var deletePlotIDs = change && change.deletePlotIDs || [];

    var mapOptions = {plots: {}};


    if (!isNaN(nextActivePlotID)) {
        if (nextActivePlotID == this.lastActivePlot && !change) return;
        zclog('[map] to active plot :', nextActivePlotID, '; deactive:', this.lastActivePlot)

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

    this.eleAddr && this.eleAddr.html(this.plots[nextActivePlotID] && this.plots[nextActivePlotID]['addr'] || '')

    if (!isNaN(nextActivePlotID)) {
        this.lastActivePlot = nextActivePlotID;
    }

    if (change) {
        this.plots_on_map = change.toShowIDs;
    }

}


ZCMap.prototype._lightSinglePlotAndChangeAuto = function (nextPlotID) {

    var all = this.all_plots_ids, to_show_ids, me = this;

    if (nextPlotID >= 0) {
        to_show_ids = this._mode_status == 'right' ? all.slice(all.indexOf(nextPlotID)) : all.slice(0, nextPlotID + 1);
    }
    else {
        to_show_ids = all;
    }


    var to_add_ids = _.difference(to_show_ids, me.plots_on_map),
        to_del_ids = _.difference(me.plots_on_map, to_show_ids);

    ZCMap.log('[map] on  ', this.plots_on_map)
    ZCMap.log('[map] to_show ', to_show_ids)
    ZCMap.log('[map] to_add ', to_add_ids)
    ZCMap.log('[map] to_del ', to_del_ids)

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

ZCMap.prototype._updateInfo = function (id) {
    if (!this._infoEle) {
        return;
    }

    var infoData = this._infoData;
    if (!infoData[id]) {
        zclog('[map] info not found id ', id, ' in ', infoData);
        return;
    }

    if (!this._infoVue) {
        var data = {};

        for (var ki in this._infoKeys) {
            data[this._infoKeys[ki]] = infoData[id][this._infoKeys[ki]];
        }
        this._infoVue = new Vue({
            el: this._infoEle,
            data: data,
        })
    } else {
        for (var ki in this._infoKeys) {
            this._infoVue[this._infoKeys[ki]] = infoData[id][this._infoKeys[ki]];
        }
    }

}

ZCMap.prototype.update = function (nextActivePlotID) {

    nextActivePlotID = parseInt(nextActivePlotID);

    this._updateInfo(nextActivePlotID);

    if (this.inMode()) {
        if (nextActivePlotID < 0) { // 注意：滑入 quote类的slide，则退出特殊模式
            this.exitMode();
        }

        this._lightSinglePlotAndChangeAuto(nextActivePlotID)

    } else {
        this._ActiveOrChangePlot({active: nextActivePlotID})
    }
}

ZCMap.prototype.lightUp = function () {
    var id = this.all_plots_ids[parseInt(this.all_plots_ids.indexOf(this.lastActivePlot)) - 1];
    this.update(id);
}
ZCMap.prototype.lightDown = function () {
    var plus = this.all_plots_ids.indexOf(this.lastActivePlot) + 1;
    var id = this.all_plots_ids[plus == this.lastActivePlot.length ? 0 : plus];
    this.update(id);
}
