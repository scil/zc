export {workAccordingScreen}
import {log as zclog, smScreen, notSmScreen} from "./util";

const RESIZE_WAIT_TIME = 220;

/**
 // 能力：让各组函数顺序执行 不精深 目前似乎也没啥用处 但不排除日后可能有些函数有先后要求
 // 特征：_pool里一个key储存相关的一组函数，控制级别是组；未来可将 delay, runEnterNow 等功能分配到各个函数上 定制能力细化到函数级别

 level: 数字越小越优先

 callback分两类，resize和enter:
 * 屏幕大变，只运行enter函数，不会运行resize函数
 * _timerID 也是为两者分别存储，意味着，resize会覆盖前面的resize，但不覆盖前面的enter.
 *    之前只设了一个id，导致屏幕变 xs 时，enterXsCallback没有执行，被后面的 xsResizeCallback 覆盖了。在chrome上，屏幕变，不知道为什么连续产生了两个resize事件
 */
var workAccordingScreen = {

    lastScreenIsSm: null,
    _configPool: {},
    // 按照运行顺序储存 如 ['100 scroll', '90 mouse','  10 affix ']
    _order: [],
    _inited: false,
    init: function () {
        if (this._inited) return;
        this._inited = true;

        zclog('[screen] init ');
        var me = workAccordingScreen;
        me.lastScreenIsSm = smScreen();


        $(window).resize(function () {
            var i;
            var xs = smScreen();


            // 屏幕未大变
            if (me.lastScreenIsSm === smScreen()) {
                if (xs) {
                    me._run('xsResizeCallback')
                } else {
                    me._run('bigResizeCallback')
                }
                return;
            }

            // 屏幕大变
            me.lastScreenIsSm = xs;
            if (xs) {
                me._run('enterXsCallback')
            } else {
                me._run('enterBigCallback')

            }
        })

    },
    _timerID: {'resize': null, 'enter': null},
    _run: function (whichType) {
        var bigType = whichType.substr(0, 2) == 'en' ? 'enter' : 'resize';
        var me = this;
        if (me._timerID[bigType]) {
            clearTimeout(me._timerID[bigType]);
            // zclog('[screen] clear timeout for ' + bigType);
        }

        me._timerID[bigType] = setTimeout(function () {
            var len = me._order.length;
            var currentKey;
            for (var i = 0; i < len; i++) {
                currentKey = me._order[i];
                if (me._configPool[currentKey][whichType]) {
                    zclog('[screen] run ' + whichType + ': ' + currentKey);
                    me._configPool[currentKey][whichType](me._configPool[currentKey]);
                }
            }
        }, RESIZE_WAIT_TIME);

    },

    /**
     *
     * @param config 除了官方key，还可自由添加其它属性,方便callback使用，因为 callback 运行时用config做属性，
     config: {
            name,
            level,
            runResizeNow,  // bool
            runEnterNow,  // bool
            xsResizeCallback,
            bigResizeCallback,
            enterXsCallback,
            enterBigCallback,
            }
     所有函数运行时，都传入参数config 这样可传入过多数据

     */
    add: function (config) {
        if (!(config.level && config.name)) return;

        var key = config.level + ' ' + config.name;
        this._order.push(key);
        this._order.sort(
            function sortNumber(a, b) {
                return parseInt(a) - parseInt(b);
            }
        );
        this._configPool[key] = config;
        zclog('[screen] add: ' + key);
        if (config.runEnterNow) {
            var i;
            if (smScreen()) {
                config.enterXsCallback && config.enterXsCallback(config);
            } else {
                config.enterBigCallback && config.enterBigCallback(config);
            }

        }
        if (config.runResizeNow) {
            if (smScreen()) {
                config.xsResizeCallback && config.xsResizeCallback(config);
            } else {
                config.bigResizeCallback && config.bigResizeCallback(config);
            }

        }
    },
};

workAccordingScreen.init();
