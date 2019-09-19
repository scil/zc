export {viewport, viewportRef, viewportTest};

import {log as zclog} from "./util";

/*
 * 特点
 * - 使用了api getBoundingClientRect   还有一个思路是用$element.offset()和$(window).scrollTop()之类
 * - 根据zc网站的需要　只实现了y轴　未考虑x轴
 * - http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport/7557433#7557433
 */
let viewport = {
    partVisibleAbove: function (rec) {
        // 在viewport 上部显示了部分
        return rec.top < 0 && 0 < rec.bottom && rec.bottom < $(window).height();
    },
    partVisibleBelow: function (rec) {
        // 在viewport 下部显示了部分
        return 0 < rec.top && rec.top < $(window).height() && rec.bottom > $(window).height();
    },
    visibleTopToBottom: function (rec) {
        // viewport从上到下　都是这个元素　但可能没有显示完全 也可能恰好显示完全了
        return rec.top <= 0 && rec.bottom >= $(window).height();
    },
    outAbove: function (rec) {
        return rec.bottom <= 0;
    },
    outBelow: function (rec) {
        return rec.top >= $(window).height();
    },
    out: function (rec) {
        return this.outAbove(rec) || this.outBelow(textRectangle)
    },
    anyVisible: function (rec) {
        // 任意部分显示出来
        return this._notNone(rec)
            && !this.out(rec); // 利用 out 比较简便
    },
    fullyVisible: function (rec) {
        // 元素完全显示出来
        return this._notNone(rec)
            && rec.top >= 0 && rec.bottom <= $(window).height();

    },
    _notNone: function (rec) {
        return rec.width > 0 && rec.height > 0     // 防止那种　display:none;的元素
    },

};

let viewportRef = {

    below: (rec, refRec) => {

        return rec.top >= refRec.top + refRec.height;
    },
};

function viewportTest(el) {
    if (typeof jQuery !== 'undefined' && el instanceof jQuery) el = el[0];
    const rect = el.getBoundingClientRect();
    for (let i in viewport) {
        i && zclog(i, viewport[i](rect))
    }
}


