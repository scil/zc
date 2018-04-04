export {scrollSpy}
import {viewport, viewportTest} from "./viewport";
import {log as zclog} from "./util";

// 不断定位显示在屏幕最上方的目标元素 对元素进行操作
class ScrollSpy {
    constructor(){

        this.eventAdded=false;

        let me = this;
        this.handler = ()=>{
            handler(me);
        };


        // 这类回调4个参数：当前id 当前ele,上回id,上回ele
        this.H1Does = [];
        this.timer= null;
        this.getId =null;

        this.H1List = [];
        this.H1Query = '';
        this.lastH1 = null;
        this.lastID = null;

        // 用处：鼠标起作用时，或者map info swipe时，停用elementSpy
        // 和注册到 zc.workAccordingScreen.的config里的enabled不同，那个只负责大小屏
        this.doEnabled = false;

        // like doEnabled, but for asyn
        this.lock = 0;
    }
    init(query: string, getId: callable) {

        // a callback return a normal integer or NaN
        this.getId = getId;

        this.updateH1s(query);
    }


    updateH1s(query: string) {
        //todo 如果列表变化，这个变量也需要更新
        this.H1Query = query;
        return this.H1List = $(this.H1Query);
    }

    getFirstVisibleH1() {
        var h1;
        this.H1List.each(function (index, element) {
            if (viewport.fullyVisible(this.getBoundingClientRect())) {
                h1 = this;
                return false;
            }
        });
        return h1;

    }

    getFirstVisibleH1ID() {
        var h1 = this.getFirstVisibleH1();
        if (!h1) {
            zclog('[spy] use the first h1 ');
            h1 = this.H1List[0];
        }

        return this.getId(h1);
    }


    addEventHandler() {
        if(this.eventAdded) return;

        this.eventAdded = true;

        /*
         关于事件捕捉　
         -　见：　http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport/7557433#7557433
         -　还不完美　如　We can't catch zoom/pinch event yet
         */

        // DOM load 这种事件，可让函数马上运行一遍

        $(window).on('DOMContentLoaded load resize scroll', this.handler);
    }
    removeEventHandler() {
        this.eventAdded = false;
        $(window).off('DOMContentLoaded load resize scroll', this.handler);
    }
    addDo (doWhat)  {
        this.H1Does.push(doWhat);
    }
    enable() {
        zclog('[spy] enable');
        this.doEnabled = true;
    }
    disable() {
        this.doEnabled = false;
        zclog('[spy] disable');
        if (this.timer) window.clearTimeout(this.timer)
    }
    enabled() {
        return this.doEnabled && this.lock === 0;
    }
    addLock() {
        zclog('[spy] lock +');
        this.lock += 1;
    }
    removeLock() {
        zclog('[spy] lock -');
        this.lock -= 1;
    }
}

function handler(me) {


    if (!me.enabled()) return;

    if (me.timer) window.clearTimeout(me.timer)

    me.timer = setTimeout(function () {

        if (!me.enabled()) return;

        const topH1 = me.getFirstVisibleH1();
        if (topH1) {

            const topEleID = me.getId(topH1);
            if (isNaN(topEleID)) return false;

            // zclog('[spy] do for id ', topEleID)
            const oldID = me.lastID, oldH1 = me.lastH1;
            me.lastID = topEleID;
            me.lastH1 = topH1;

            for (let i in me.H1Does) {
                me.H1Does[i](topEleID, topH1, oldID, oldH1);
            }


        }
    }, 400)

}

const scrollSpy = new ScrollSpy();
