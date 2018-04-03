export {viewport,viewportTest};

import {log as zclog} from "./util";

/*
 * 特点
 * - 使用了api getBoundingClientRect   还有一个思路是用$element.offset()和$(window).scrollTop()之类
 * - 根据zc网站的需要　只实现了y轴　未考虑x轴
 * - http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport/7557433#7557433
 */
var viewport = {
    partVisibleAbove: function (textRectangle) {
        // 在viewport 上部显示了部分
        return textRectangle.top < 0 && 0 < textRectangle.bottom && textRectangle.bottom < $(window).height();
    },
    partVisibleBelow: function (textRectangle) {
        // 在viewport 下部显示了部分
        return 0 < textRectangle.top && textRectangle.top < $(window).height() && textRectangle.bottom > $(window).height();
    },
    visibleTopToBottom: function (textRectangle) {
        // viewport从上到下　都是这个元素　但可能没有显示完全 也可能恰好显示完全了
        return textRectangle.top <= 0 && textRectangle.bottom >= $(window).height();
    },
    outAbove: function (textRectangle) {
        return textRectangle.bottom <= 0;
    },
    outBelow: function (textRectangle) {
        return textRectangle.top >= $(window).height();
    },
    out: function (textRectangle) {
        return this.outAbove(textRectangle) || this.outBelow(textRectangle)
    },
    anyVisible: function (textRectangle) {
        // 任意部分显示出来
        return this._notNone(textRectangle)
            && !this.out(textRectangle); // 利用 out 比较简便
    },
    fullyVisible: function (textRectangle) {
        // 元素完全显示出来
        return this._notNone(textRectangle)
            && textRectangle.top >= 0 && textRectangle.bottom <= $(window).height();

    },
    _notNone: function (textRectangle) {
        return textRectangle.width > 0 && textRectangle.height > 0     // 防止那种　display:none;的元素
    }
}

function viewportTest(el) {
    if (typeof jQuery !== 'undefined' && el instanceof jQuery) el = el[0];
    var rect = el.getBoundingClientRect();
    for (var i in viewport) {
        i && zclog(i, viewport[i](rect))
    }
}
