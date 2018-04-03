export {elementsSpy}
import {viewport, viewportTest} from "./viewport";
import {log as zclog} from "./util";

// 不断定位显示在屏幕最上方的目标元素 对元素或元素的id进行操作
var elementsSpy = {
    // 这类回调4个参数：当前id 当前ele,上回id,上回ele
    _H1Does: [],

    _H1List: [],
    _H1Query: '',
    _attrWithID: '',
    _lastH1: null,
    _lastID: null,
    updateH1s: function (query: string) {
        //todo 如果列表变化，这个变量也需要更新
        this._H1Query = query;
        return this._H1List = $(this._H1Query);
    },
    _inited: false,
    // 用处：鼠标起作用时，或者map info swipe时，这里就不用起作用了
    // 和注册到 zc.workAccordingScreen.的config里的enabled不同，那个只负责大小屏
    _doEnabled: true,
    getFirstVisibleH1:

        function () {
            var h1;
            this._H1List.each(function (index, element) {
                if (viewport.fullyVisible(this.getBoundingClientRect())) {
                    h1 = this;
                    return false;
                }
            });
            return h1;

        }

    ,
    getFirstVisibleH1ID: function () {
        var h1 = this.getFirstVisibleH1();
        if (!h1) {
            zclog('[spy h1] use the first h1 ');
            h1= this._H1List[0];
        }

        return h1.getAttribute(this._attrWithID)
    }
    ,
    init: function (query: string, attrWithID?: string) {

        if (this._inited) return;
        this._inited = true;
        this._doEnabled = true; // 可能会被这个鼠标事件改变，故宽屏初始化时确定为 true : $(opts.listArea).mouseenter

        this._attrWithID = attrWithID || 'id';

        this.updateH1s(query);
    }
    ,
    _timer: null,
    _handler:

        function () {

            var me = elementsSpy;

            if (!me._doEnabled) return;

            if (me._timer) window.clearTimeout(me._timer)

            me._timer = setTimeout(function () {

                if (!me._doEnabled) return;

                var topH1 = me.getFirstVisibleH1();
                if (topH1) {

                    var topEleID = parseInt(topH1.getAttribute(me._attrWithID));
                    if (isNaN(topEleID)) return false;

                    zclog('[spy] do for id ', topEleID)

                    var oldID = me._lastID, oldH1 = me._lastH1;
                    me._lastID = topEleID;
                    me._lastH1 = topH1;

                    for (var i in me._H1Does) {
                        me._H1Does[i](topEleID, topH1, oldID, oldH1);
                    }


                }
            }, 400)

        }

    ,
    addEventHandler: function () {

        /*
         关于事件捕捉　
         -　见：　http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport/7557433#7557433
         -　还不完美　如　We can't catch zoom/pinch event yet
         */

        // DOM load 这种事件，可让函数马上运行一遍
        $(window).on('DOMContentLoaded load resize scroll', this._handler);
    }
    ,
    removeEventHandler: function () {
        $(window).off('DOMContentLoaded load resize scroll', this._handler);
    }
    ,
    addDo: function (doWhat) {

        this._H1Does.push(doWhat);

    }
    ,
    enable: function () {
        this._doEnabled = true;
    }
    ,
    disable: function () {
        this._doEnabled = false;
        if (this._timer) window.clearTimeout(this._timer)
    }
    ,
};
