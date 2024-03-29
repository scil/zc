// @flow

import {workAccordingScreen} from "./work_according_screen"
import {viewport, viewportRef, viewportTest} from "./viewport";
import {scrollSpy} from "./scrollspy";
import {log as zclog, smScreen, notSmScreen} from "./util";
import {ZCMap} from "./zcmap";
import getG from "./g"

const getMDParser = require('./markdownit');

// why , give `this._updateMap(id);` enough time to redraw the map info, so
// `me.affixEle.outerHeight(true)` return the height with the new info
const WAIT_TIME_TO_SCROLL_UP = 100;

const SCROLL_UP_TIME = 300;

const SCROLLSPY_RESTORE_WAIT_TIME_AFTER_SCROLL_UP = 100;

// 30 合适，我觉得道理是 .affix{top:30px}
const SCROLL_UP_GAP = 30;

var zc = {
    canTouch: 'ontouchstart' in document,
    canMouse:'onmouseover' in document,
    editor: {
        init: function (id) {

            if (typeof(use_tinymce) == "boolean" && use_tinymce) {
                return this._initSimpleMDE('#' + id + '-box')
            } else if (typeof(SimpleMDE) == 'function') {
                return this._initSimpleMDE($("#" + id)[0])
            } else if (typeof(editormd) == 'function') {
                return this._initEditormd(id + '-box')
            }

        },
        _md: null,
        getMarkdownParser: function () {
            if (zc.editor._md) {
                return zc.editor._md;
            }

            return zc.editor._md = getMDParser();
        },
        rendMarkdown: function (sMD, option) {
            var parser = this.getMarkdownParser();
            // todo use html-minifier  use webpack  or browserify
            // https://www.zhihu.com/question/37020798
            parser.render(sMD)
        },
        _initTinymce: function (selector) {
            $.getScript('https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.13/jquery.tinymce.min.js', function () {
                var editor = tinymce.init({
                    selector: selector,
                    element_format: "html",
                    indentation: '2em',
                    menubar: true,
                    content_css: "/css/app.css",
                    forced_root_block: 'p',
                });

                return editor;
            })

        },
        _initSimpleMDE: function (ele) {

            var md = zc.editor.getMarkdownParser();

            var editor = new SimpleMDE({
                element: ele,
                autoDownloadFontAwesome: false,
                spellChecker: false,
                indentWithTabs: false,
//                    autosave: {enabled: true, uniqueId: "article", delay: 1000,},
//                    previewRender: function(plainText, preview) { // Async method
//                        setTimeout(function(){
//                            preview.innerHTML = md.render(plainText);
//                        }, 250);
//
//                        return "Loading...";
//                    },
                previewRender: function (plainText) {
                    return md.render(plainText);
                },
            });


            var cm = editor.codemirror;
            emmetCodeMirror(cm);
            $(cm.getTextArea()).data('codemirror', cm);

            return editor;
        },
        _initEditormd: function (id) {
            var w = $('#' + id).parent().width();
            var editor = editormd({
                autoLoadModules: false,  // path: "/editor.md.lib/", // Manually load modules
                htmlDecode: true,
                id: id,
                height: 480,
                width: w,
                markdown: "#### Editor.md B",
                atLink: false,
                emailLink: false,
                toolbarIcons: function () {
                    // Or return editormd.toolbarModes[name]; // full, simple, mini
                    // Using "||" set icons align right.
                    return [
                        "undo", "redo", "|", "bold", "del",
//                    "italic",
                        "quote",
//                    "ucwords", "uppercase", "lowercase",
                        "|", "h1", "h2", "h3", "h4", "h5", "h6",
                        "|", "list-ul", "list-ol", "hr",
                        "|", "link", "reference-link",
                        "|", "image",
                        //"code", "preformatted-text", "code-block",
                        "table",
//                    "datetime",
                        "emoji", "html-entities",
//                    "pagebreak", "goto-line",
                        "||", "watch", "preview", "fullscreen",
//                    "clear", "search",
                        "help",
                    ]
                },
                onload: function () {
                    // editor界面就绪之后才能使用 否则浏览器报错：TypeError: this.cm is undefined
                    $.ajax({
                        url: '/js/emmet.js',
                        dataType: "script",
                        cache: true,
                    }).done(function (script, status) {
                        emmetCodeMirror(editor
                            // 提供二参，甚至只是提供 {} ，都导致emmet的 ctrl-e 失灵
//                        , { 'Cmd-H': 'emmet.expand_abbreviation_with_tab',}
                        )
                    });

                }
            });
            return editor;

        },
    },
    form: {
        init: function () {
            this.initSelect();
            this.initCode();
            this.monitorChange()
            this.initSubmit();
            this.initDelBtn();
        },
        initSelect: function () {
            // 选中当前栏目
            if (typeof(column_id) == 'number') {
                $('select[name="column_id"]').val(column_id);
            }

            $("select").select2();
        },

        _monitorHandler: function () {
            $(this).off('change', zc.form._monitorHandler)
            if (this.hasAttribute('name')) {
                console.log(this.getAttribute('name'))
                $(this.form).data('monitorChange').push(this.getAttribute('name'));
            }
            return false;

        },
        _monitorCodemirrorHandler: function (cm) {
            cm.off('change', zc.form._monitorCodemirrorHandler)
            var textarea = cm.getTextArea();
            if (textarea.hasAttribute('name')) {
                console.log(textarea.getAttribute('name'))
                $(textarea.form).data('monitorChange').push(textarea.getAttribute('name'));
            }
            return false;
        },
        monitorChange: function () {
            $('form').data('monitorChange', []);
            $('form').data('monitorChangeFor', []);

            var eles = $('.monitor-change');
            eles.each(function () {
                if (!this.hasAttribute('name'))
                    return;

                $(this.form).data('monitorChangeFor').push(this.getAttribute('name'));

                var me = $(this);
                if (me.data('codemirror')) {
                    me.data('codemirror').on('change', zc.form._monitorCodemirrorHandler)
                } else {
                    me.change(zc.form._monitorHandler)
                }
            })
        },
        initCode: function () {
        },
        initDelBtn: function () {
            $('.btn-del').on('click', function (event) {
                event.preventDefault();

                $.post(this.form.action, {_method: 'DELETE'})
                    .fail(function (data) {
                        console.log(data.responseText || data);
                    })

            })
        },
        initSubmit: function () {
            $('form').on('submit', function (event) {
                event.preventDefault();

                var f = $(this);
                data = f.serializeObject();

                $.each(f.data('monitorChangeFor'), function (index, value) {
                    if (f.data('monitorChange').indexOf(value) == -1) {
                        delete data[value];
                    }

                });

                // body 使用了 SimpleMDE 编辑器 ，其加密和解析需调用 SimpleMDE API
                if (data.body) { //  body 如果没有进入 monitorChange ，刚才就会被删除
                    data.md = editor.value();
                    data.body = md.render(editor.value());

                }

                console.log('submited data: ', data);

                $.post(f.attr('action'), data)
                    .done(function (data) {
                        alert("Data Loaded: " + data);
                    })
                    .fail(function (data) {
                        console.log(data.responseText || data);
                    });


            })

        },
    },

    sideMap: {
        /** @type {jQuery} */
        contentArea: null,

        /** @type {jQuery} */
        affixEle: null,

        /** @type {number} */
        beginAffixPosition: null,

        /** @type {ZCMap} */
        zcmap: null,

        /** @type {number[]} */
        IDs: null,

        /** @type {number} */
        lastID: null,

        // only one scroll up action allowed for contentArea at a time
        /** @type {boolean} */
        in_up: false,

        // /**
        //  * @callback findItem
        //  * @param {number}
        //  * @return {jQuery|undefined}
        //  */
        // /** @type {findItem} */
        /** @type {function(number):jQuery|undefined} */
        findItemByPlotID: null,


        init: function (opts) {


            this.IDs = opts.itemIDs;

            this.zcmap = new ZCMap(
                {
                    ele: $("#LMap"),
                    plotsIDs: opts.itemIDs,
                    plots: opts.plots,
                    mode: 'all',
                    direction: 'ltr',
                    config: {
                        plotSize: 15,
                    },// plotColor:'#8800CC'},
                    mouseoverCallback: (e, id, mapElem, textElem, elemOptions) => {
                        zc.sideMap._updateMapThenUpContent(id);
                    }
                },
                {
                    ele: opts.side.infoEle,
                    infoElements: opts.side.infoElements,
                    data: opts.side.infoData,
                    infoSwipeBox: false, // 不需要ZCMap提供的swipe 自定义swipe 动作，增加 scrollUp
                }
            );

            // I think safari 10 should works fine with afffix because:
            // https://github.com/twbs/bootstrap/issues/16814 and
            // https://en.wikipedia.org/wiki/Safari_version_history#Safari_10
            if (navigator.userAgent.indexOf('Safari') != -1
                && navigator.userAgent.indexOf('Chrome') == -1
                && navigator.userAgent.indexOf('Android') == -1
                && /Version\/(\d+)\./.exec(navigator.userAgent)[1] < 10
            ) {
                var cc = $('#column-box').children();
                cc.first().removeClass('col-sm-push-7')
                cc.last().removeClass('col-sm-pull-5')
                console & console.warn('col classes changed for old Safari browsers.')
            }
            else {
                // 实现靠右，用动态的 margin-left，而非浮动、绝对定位，是因为 affix
                workAccordingScreen.add({
                    name: 'side_400px',
                    level: 5,
                    runEnterNow: true,

                    sideEle: opts.side.ele,
                    bigResizeCallback: this._side400,
                    enterBigCallback: this._side400,
                    enterXsCallback: this._sideLess400,
                });
            }

            this._initWidth(opts);

            this._initAffix(opts);

            this._initContentArea(opts);

            this._initSwipeBox(opts);

            if(opts.lightID){
                const id = typeof(opts.lightID)==='function'? opts.lightID(): opts.lightID;

                this._updateMap(id, 0)
            }
        },

        _initContentArea: function (opts) {
            if (!opts.contentArea) return;

            this.contentArea = $(opts.contentArea);
            this.findItemByPlotID = opts.findItemByPlotID;

            this.contentArea.on('sidemap.update', function (e, id, last_id) {
                if (opts._previous) { // neverthelevee smScreen or notSmScreen
                    opts._previous.removeClass('L-item-opacity');
                    opts._previous = null;
                }
                if (opts.getPrevious && smScreen()) {
                    const p = opts.getPrevious(id);
                    if (p.length > 0) {
                        opts._previous = p;
                        p.addClass('L-item-opacity');
                    }
                }
                $('#' + last_id).parents('article').removeClass('active');
                $('#' + id).parents('article').addClass('active');
            });

            if (opts.spy) this.__initSpy(opts);
        },

        __initSpy:function(opts){

            // 根据窗口滚动 map 高亮屏幕上的第一个title
            // update map red plot according to the first article h1 title on screen
            // 显示标准是viewport第一个标题，所以bootstrap的 scrollspy不适合
            scrollSpy
                .init(
                    opts.spy.field + ' ' + opts.spy.target,
                    opts.spy.getId || function (targetElement) {
                        // return  a real integer or NaN
                        return parseInt(targetElement && targetElement.getAttribute('id'));
                    },
                    opts.side.affixEle && opts.side.affixEle[0],
                )
                .addDo(function lightViewTopH1(id: number, ele, lastId: number, lastEle) {
                     zclog('[spy do] try update map for id ', id);
                    zc.sideMap._updateMap(id, 0)
                });

            // if (zc.canTouch) this.__initTouch(opts)
            // else this.__initMouse(opts);
            zc.canMouse && this.__initMouse(opts);
            zc.canTouch && this.__initTouch(opts);
        },

        __initTouch: function (opts) {

            $(opts.contentArea).on('touchover', (e) => {

                const id = scrollSpy.getId(
                    $(e.target).closest(opts.spy.targetItemScope, this).find(opts.spy.target)[0]
                );

                // 发现 #L 有两侧padding 进入padding是找不到合适 article的 这时 id 没有
                if (isNaN(id)) return

                zclog('[touch] try update map for id ', id);
                zc.sideMap._updateMap(id, 70)
            })

        },
        __initMouse: function (opts) {



            // 根据鼠标动作  map 高亮鼠标下的 article
            // 鼠标进入目标区域后 不停止 scrollSpy
            $(opts.contentArea).mouseover((e) => {

                // if (smScreen()) return false;

                e.preventDefault();

                const id = scrollSpy.getId(
                    $(e.target).closest(opts.spy.targetItemScope, this).find(opts.spy.target)[0]
                );

                // 发现 #L 有两侧padding 进入padding是找不到合适 article的 这时 id 没有
                if (isNaN(id)) return

                zclog('[mouse] try update map for id ', id);
                zc.sideMap._updateMap(id, 70)
            })

        },

        _initSwipeBox: function (opts) {

            if (!opts.side.swipeBoxEle) return;

            opts.side.swipeBoxEle.swipe({
                swipe: function (event, direction, distance, duration, fingerCount, fingerData) {

                    // just disable scrollSpy for a little while, the key to stop scrollSpy is using addOneLock in zc.sideMap._2Ajacent
                    scrollSpy.disable();

                    zc.sideMap._2Adjacent(direction === 'right');

                    scrollSpy.enable();
                },
                //Default is 75px,
                threshold: 30
            });


        },

        /**
         * 原因1:
         在 chrome 59 中发现 ，被 .affix 的元素 如果其中的子元素没有确定width 会导致这些元素被长内容撑得非常长；
         在firefox 53 中也有类似问题，但撑得不太长
         这说明一个元素被fixed 就脱离了原来容器的控制
         解决：给定一个width, 根据元素 opts.side.ele 的长度而变化

         * 原因2:
         * 文章页没有使用affix 但也出现宽度过大，所以也需要设置，发现是需要:
                 opts.side.ele.css('float', 'none');
         */
        _initWidth:(opts)=>{
            var who = opts.side.widthEle||opts.side.affixEle;
            if(!who) return;

            opts.side.ele.css('float', 'none');

            workAccordingScreen.add({
                name: 'side_width',
                level: 6, // it must be after 'side_400px' because the children width depends opts.side.ele
                runEnterNow: true,

                sideEle: opts.side.ele,
                //todo test
                // elements: [opts.side.affixEle, opts.side.swipeBoxEle],
                elements: [who,],

                bigResizeCallback: zc.sideMap._affixWidth,
                enterBigCallback: zc.sideMap._affixWidth,
                enterXsCallback: zc.sideMap._affixWidth,
                xsResizeCallback: zc.sideMap._affixWidth,
            });
        },

        _initAffix: (opts) => {

            if (!opts.side.affixEle) return;

            zc.sideMap.affixEle = opts.side.affixEle;



            workAccordingScreen.add({
                name: 'affix',
                level: 6,
                runEnterNow: true,

                affixEle: $(opts.side.affixEle),
                contentArea: $(opts.contentArea),

                enterBigCallback: function (config) {
                    zc.sideMap._destroyAffix(config);
                    zc.sideMap._initSideAffix(config);
                },
                enterXsCallback: function (config) {
                    zc.sideMap._destroyAffix(config);
                    zc.sideMap._initTopAffix(config);
                },

            });

        },
        _2Adjacent: function (previous: boolean) {

            if (this.in_up) return;

            let id;
            if (zc.sideMap.lastID === null) {
                // use the first
                id = zc.sideMap.IDs[0];
            } else {
                let lastIndex = zc.sideMap.IDs.indexOf(zc.sideMap.lastID)
                if (previous) {
                    // use the prevous one or last one
                    id = zc.sideMap.IDs[lastIndex <= 0 ? zc.sideMap.IDs.length - 1 : lastIndex - 1];
                }
                else {
                    // use the next one or the first one
                    id = zc.sideMap.IDs[lastIndex === zc.sideMap.IDs.length - 1 ? 0 : lastIndex + 1];
                }

            }
            zc.sideMap._updateMapThenUpContent(id);
        },
        _updateMapThenUpContent: function (id: number) {

            if (this.in_up) return;

            /** @type {jQuery|undefined} */
            const item = this.findItemByPlotID(id);

            if (item) {
                zclog('[up] in_up and try ', item.get(0));

                this.in_up = true;
                scrollSpy.addOneLock();
            }

            this._updateMap(id, 0);

            if (!item) return;

            let me = this;

            setTimeout(() => {

                let pos;

                if (smScreen()) {
                    // zclog('[up] affix height: ', me.affixEle.outerHeight(true))
                    pos = item.offset().top - me.affixEle.outerHeight(true) - SCROLL_UP_GAP;

                    if (pos < zc.sideMap.beginAffixPosition) pos = zc.sideMap.beginAffixPosition;

                    zclog('[up] pos: ', pos);

                } else {
                    pos = item.offset().top - SCROLL_UP_GAP;
                }


                // someone said both of 'html' and 'body' are needed
                //      https://stackoverflow.com/questions/16475198/jquery-scrolltop-animation
                //$('html, body').animate
                //      but that cause `scrollSpy.removeLock();` run twice
                //
                // now I test 'html', it works on chrome65 and firefox
                $('html').animate({
                    scrollTop: pos
                }, SCROLL_UP_TIME, () => {
                    zc.sideMap.in_up = false;
                    zclog('[up] in_up stop');
                    setTimeout(() => {
                        scrollSpy.removeOneLock();
                    }, SCROLLSPY_RESTORE_WAIT_TIME_AFTER_SCROLL_UP)
                });
            }, WAIT_TIME_TO_SCROLL_UP);

        },
        updateMapTimer: null,
        _updateMap: function (id: number, timeout: number) {
            if (zc.sideMap.lastID === id) {
                return;
            }

            if (this.updateMapTimer) clearTimeout(this.updateMapTimer);

            this.updateMapTimer = setTimeout(() => {
                zclog('[list] trigger sidemap.update for id ', id);

                zc.sideMap.contentArea.trigger('sidemap.update', [id, zc.sideMap.lastID]);

                zc.sideMap.lastID = id;

                zc.sideMap.zcmap.update(id)

            }, timeout || 0)


        },

        _side400: function (config) {
            // if (xsScreen()) return;
            var spareWidth = config.sideEle.parent().width() - 400;
            if (spareWidth > 0) {
                // side靠右
                config.sideEle.css('margin-left', spareWidth + 'px');

                zclog('[side] margin-left: ' + spareWidth);

            } else {
                zc.sideMap._sideLess400(config);
            }
        },
        _sideLess400: function (config) {

            if (parseFloat(config.sideEle.css('margin-left')) > 0) {

                config.sideEle.css('margin-left', '');
                // zclog('[side] margein left quit');

            }
        },
        _affixWidth: function (config) {
            var sideWidth = config.sideEle.width() + 'px';

            for (var ele in config.elements) {
                config.elements[ele].width(sideWidth);
            }

            zc.sideMap.zcmap.paper.setSize('100%', '100%');

            zclog('[side width] re-width and svg resized');

        },

        _destroyAffix: function (config) {

            $(window).off('.affix');
            $(config.affixEle).removeData('bs.affix').removeClass('affix affix-top affix-bottom');


            // 实践证明，removeData不能去掉绑定的事件函数 需手动
            $(config.affixEle).off('affixed.bs.affix');
            $(config.affixEle).off('affix-top.bs.affix');
            config.contentArea.css('margin-top', '');

            zclog('[affix] clear');
        },
        _initSideAffix: function (config) {

            zclog('[affix] side set')
            var $affixEle = config.affixEle;


            //        bootstrap侧边固定导航
            //        当页面向下滚动了 top 长，.affix-top切换成.affix类 开始变化
            //        页面滚动到离底部距离为 bottom 时，.affix类切换成.affix-bottom
            //        http://blog.tanteng.me/2014/02/bootstrap-affix/
            // 避免地图抖动， jq给的top没计算margin-top,　30 见.affix{top:30px;}
            var pos = zc.sideMap.beginAffixPosition = $affixEle.offset().top - parseInt($affixEle.css('marginTop')) - 30;


            $affixEle.affix({
                offset: {
                    top: pos,
                    bottom: function () {
                        return ($('#footer').outerHeight(true) + $('#quotes-slide').outerHeight(true) - 100); // 100 只是个概数
                    }
                }
            });


        },
        _initTopAffix: function (config) {
            zclog('[affix] top set')
            var $affixEle = config.affixEle;

            // 避免地图抖动， jq给的top没计算margin-top,　30 见.affix{top:30px;}
            var pos = zc.sideMap.beginAffixPosition = $affixEle.offset().top - parseInt($affixEle.css('marginTop')) - 30;

            $affixEle.affix({
                offset: {
                    top: pos,
                    bottom: function () {
                        return ($('#footer').outerHeight(true) + $('#quotes-slide').outerHeight(true) + 100); // 100 只是个概数
                    }
                }
            });

            // why set margin-top, because position:fix on $affixEle would drive the contentArea go up
            $affixEle.on('affixed.bs.affix', () => {
                zclog('[affix] list margin-top')
                config.contentArea.css('margin-top', $affixEle.outerHeight(true));
            });
            $affixEle.on('affix-top.bs.affix', () => {
                config.contentArea.css('margin-top', '');
                zclog('[affix] list margin-top removed')
            });


        },

    },
    content: {
        _inited: false,
        init:

            function () {
                if (this._inited) return;
                this._inited = true;

                this._renderMDElement();
                this._bigHref();
                this._socialLink();
                this.oneLineHeight();
            }

        ,

        oneLineHeight: function () {
            $('.one-line-height').click(function () {
                // -100 : 怕有什么小差错
                if ($(this).hasClass('show')) {
                    $(this).removeClass('show')
                        .animate({'height': $(this).data('height')}, 300);
                } else {
                    $(this).addClass('show').animate({'height': this.scrollHeight}, 300)
                        .data('height', $(this).css('height'))
                }
            })
        }
        ,
        limitHeight: function (opt) {
            opt.containers.prepend('<span class="read-more"></span>')

            var currentButton, currentContaner, expanded = [];

            var allLen = $('.read-more').click(function () {
                var button = $(this);
                var container = button.parent();
                // 变大状态
                if (button.hasClass('read-less')) {
                    var button_top_distance = button.offset().top;
                    opt.readLess(container, button);
                    zclog('scroll ', button.offset().top - button_top_distance)
                    opt.scrollBack && window.scrollBy(0, button.offset().top - button_top_distance);
                    if (opt.fix) {
                        expanded.splice(container.data('read-more-expand'), 1)
                        unfixButton(button)
                    }
                } else {
                    // 默认小型状态
                    opt.readMore(container, button);
                    if (opt.fix) {
                        var index = expanded.push([button, container]) - 1;
                        container.data('read-more-expand', index)
                        fixButton(button, container)
                    }
                }
            }).length;
            var fixBottom = 20;
            var fixButton = function (button, container) {
                    if (button.is(currentButton)) return;

                    var right_distance = ($(window).width() - (button.offset().left + button.outerWidth()));
                    button.css({
                        position: 'fixed',
                        right: right_distance,
                        bottom: fixBottom + 'px'
                    })
                    currentButton = button;
                    currentContaner = container;
                },
                unfixButton = function (button) {
                    if (button && !button.is(currentButton)) return;
                    currentButton.css({
                        position: '',
                        right: '',
                        bottom: ''
                    })
                    currentButton = null;
                    currentContaner = null;
                },
                _canCurrentButtonContinueFix = function () {
                    var bTop = currentButton.offset().top, contanerTop = currentContaner.offset().top;
                    if (contanerTop + opt.containerDefaultHeight >= bTop || bTop >= contanerTop + currentContaner.outerHeight() - fixBottom) {
                        return false
                    }
                    return true;
                },
                // 注意：只用于展开的container ，即 expanded 里面的
                _canButtonStartFix = function (button, container) {
                    // blockquote 出现在viewport　但 button没有显示　就应该启动fix
                    return viewport.anyVisible(container[0].getBoundingClientRect()) && !viewport.fullyVisible(button[0].getBoundingClientRect())
                },
                updateButtonFixStatus = function () {
                    if (currentButton && !_canCurrentButtonContinueFix()) {
                        unfixButton()
                    }
                    if (!currentButton && expanded.length > 0) {
                        $.each(expanded, function (i, item) {
                            if (_canButtonStartFix(item[0], item[1])) {
                                fixButton(item[0], item[1])
                                return false;
                            }
                        })
                    }
                };

            if (opt.fix && allLen > 0) {
                var timer;
                $(window).on('DOMContentLoaded load resize scroll', function () {
                    if (timer) window.clearTimeout(timer)
                    timer = setTimeout(updateButtonFixStatus, 200)
                });
            }
        }
        ,
        _socialLink: function () {
            $('z-wechat').replaceWith(function (index, old) {

                if ($(this).attr('parsed')) return old;

                return ['<a target="_blank" href="http://weixin.sogou.com/weixin?type=1&query=',
                    this.textContent,
                    '">',
                    this.title ? this.title + ' ' : '',
                    , '<mark parsed="true">', this.textContent, '</mark></a>'].join('');
            });
        }
        ,

        _bigHref: function () {
            $('.Big-Href').click(function () {
                $(this).find('a')[0].click();
                // if(!$(this).data('a')){
                //     $(this).data('a', $(this).find('a')[0]) );
                // }
                // $(this).data('a').click();
            })
        }
        ,
        // render markdown code
        renderMD: function (content) {

            if (typeof(content) != 'string') {
                return '';
            }

            return zc.editor.getMarkdownParser().render(content);

        }
        ,
        _renderMDElement: function () {
            // 解密
            $('.md-code').each(function () {
                var html = zc.content.renderMD(this.textContent);
                // // 避免文章正文和后记的引用冲突
                // if(this.dataset.mdFnPrefix && html.indexOf('#fn')!=-1){
                //     zclog('renderMD: change footnote prefix')
                //     var prefix = this.dataset.mdFnPrefix;
                //     html = html.replace(/<a href="#fn/g,'<a href="#'+prefix)
                //         .replace(/ id="fn/g,' id="'+prefix);
                // }
                this.innerHTML = html;
            })
        }
        ,


    }
    ,
};

zc.zclog = zclog;
zc.smScreen = smScreen;
getG().ZCMap = ZCMap;
getG().zc = zc;
