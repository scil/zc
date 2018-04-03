// @flow

import {workAccordingScreen} from "./work_according_screen"
import {viewport, viewportTest} from "./viewport";
import {elementsSpy} from "./elementspy";
import {log as zclog, xsScreen,notXsScreen} from "./util";
import {ZCMap} from "./zcmap";
import {free} from "./free";
import getG from "./g"

const getMDParser = require('./markdownit');


var zc = {
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
            $.getScript('//cdn.bootcss.com/tinymce/4.3.4/jquery.tinymce.min.js', function () {
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

            if (free.hasZcCode(editor.value()))
                editor.value(free.decodeTagedStringIndependently(editor.value()))

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

            // 解密
            $('.markdown-input').each(function () {
                if (this.value && free.hasZcCode(this.value)) {
                    this.value = free.decodeTagedStringIndependently(this.value);
                }
            })

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

                // 这些字段进行加密处理
                $.each(['quotes', 'links'], function (index, value) {
                    if (data[value] && free.hasZcCode(data[value])) {
                        data[value] = free.encodeTagedStringIndependently(data[value]);
                    }
                })

                // body 使用了 SimpleMDE 编辑器 ，其加密和解析需调用 SimpleMDE API
                if (data.body) { //  body 如果没有进入 monitorChange ，刚才就会被删除
                    if (free.hasZcCode(data.body)) {
                        data.md = free.encodeTagedStringIndependently(editor.value());
                        var md = zc.editor.getMarkdownParser();
                        data.body = free.encodeTagedHtmlStringByDom(md.render(editor.value()));
                    } else {
                        data.md = editor.value();
                        data.body = md.render(editor.value());
                    }
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

    list: {
        _zcmap: null,
        _IDs: null,
        _lastID: null,
        _lastScreenIsXs: null,

        _findItemToUp: null,
        _affixEle: null,

        _beginAffixPosition: null,

        init: function (opts) {


            zc.list._IDs = opts.itemIDs;

            zc.list._zcmap = new ZCMap(
                {
                    ele: $("#LMap"),
                    plotsIDs: opts.itemIDs,
                    plots: plots,
                    config: {
                        plotSize: 15,
                    },// plotColor:'#8800CC'},
                    mouseoverCallback: function (e, id, mapElem, textElem, elemOptions) {
                    }
                },
                {
                    ele: opts.info.ele,
                    data: opts.info.data,
                    infoSwipeBox: false, // 不需要ZCMap提供的swipe 自定义swipe
                }
            )

            zc.list._findItemToUp = opts.findItemToUp;
            zc.list._affixEle = $(opts.affix);

            // 根据窗口滚动 map 高亮屏幕上的第一个title
            // update map red plot according to the first article h1 title on screen
            // 显示标准是viewport第一个标题，所以bootstrap的 scrollspy不适合
            elementsSpy.init(opts.listArea + ' ' + opts.spy.target, opts.spy.targetAttrWithPlotID || 'id')
            elementsSpy.addDo(function lightViewTopH1(id: number, ele, lastId: number, lastEle) {
                zclog('[spy do] try update map for id ', id);
                zc.list._updateMap(id)
            });


            workAccordingScreen.init();

            // 实现靠右，用动态的 margin-left，而非浮动、绝对定位，是因为 affix
            workAccordingScreen.add({
                name: 'side_400px',
                level: 5,
                runEnterNow: true,

                sideEle: $('#side'),
                bigResizeCallback: zc.list._side400,
                enterBigCallback: zc.list._side400,
                enterXsCallback: zc.list._sideLess400,
            });

            // 在 chrome 59 中发现 ，被 .affix 的元素 如果其中的子元素没有确定width 会导致这些元素被长内容撑得非常长；
            // 在firefox 53 中也有类似问题，但撑得不太长
            // 解决：给定一个width, 根据元素 #side 的长度而变化
            workAccordingScreen.add({
                name: 'affix_child',
                level: 6, // it must be after 'side_400px' because the children width depends #side
                runEnterNow: true,

                sideEle: $('#side'),
                elements: [$(opts.affix), $('#LMap-info-swipebox')],

                bigResizeCallback: zc.list._affixChildren,
                enterBigCallback: zc.list._affixChildren,
                enterXsCallback: zc.list._quitAffixChildren,
            });

            workAccordingScreen.add({
                name: 'affix',
                level: 6,
                runEnterNow: true,

                affixEle: $(opts.affix),
                contentEle: $('#L'),

                // 为什么小屏幕也做个affix？利用grid实现图片居上很简单 但因为bug affix不能用在pull push的column中
                // https://getbootstrap.com/docs/3.3/css/#grid-column-ordering
                enterBigCallback: function (config) {
                    zc.list._destroyAffix(config);
                    zc.list._initSideAffix(config);
                },
                enterXsCallback: function (config) {
                    zc.list._destroyAffix(config);
                    zc.list._initTopAffix(config);
                },

            });

            workAccordingScreen.add({
                name: 'big_spy_h1',
                level: 7,
                runEnterNow: true,

                enabled: false,

                enterBigCallback: function (config) {
                    zclog('[spy h1] start')
                    config.enabled = true;
                    elementsSpy.enable();
                    elementsSpy.addEventHandler();
                },
                enterXsCallback: function (config) {
                    if (!config.enabled) return;

                    config.enabled = false;
                    elementsSpy.disable();
                    elementsSpy.removeEventHandler();
                    zclog('[spy h1] stop')
                },

            });
            //todo
            // if (xsScreen()) {
            //     // 单纯高亮第一个 h1 但不注册相关spy事件
            //     zc.list._updateSideMap(elementsSpy.getFirstVisibleH1ID());
            // }

            $(opts.info.swipeBox).swipe({
                swipe: function (event, direction, distance, duration, fingerCount, fingerData) {

                    elementsSpy.disable();

                    if (direction == 'left') {
                        zc.list._update2Next();
                    } else if (direction == 'right') {
                        zc.list._update2Previous();
                    }
                },
                //Default is 75px,
                threshold: 40
            });


            // 根据鼠标动作  map 高亮鼠标下的 article
            // 鼠标进入目标区域后 即停止 上面的 elementsSpy
            $(opts.listArea).mouseenter(function (e) {
                elementsSpy.disable();
            }).mouseleave(function (e) {
                elementsSpy.enable();
            }).mouseover(function (e) {

                var id = parseInt($(e.target).closest(opts.spyItem, this).find(opts.spy.target).attr(opts.spy.targetAttrWithPlotID));
                // 发现 #L 有两侧padding 进入padding是找不到合适 article的 这时 id 为 undefined
                if (!id) return

                zc.list._updateMap(id)
            })


        },
        _update2Previous: function () {
            if (zc.list._lastID === null) {
                // use the first
                var id = zc.list._IDs[0];
            } else {
                var lastIndex = zc.list._IDs.indexOf(zc.list._lastID)
                // use the prevous one or last one
                var id = zc.list._IDs[lastIndex <= 0 ? zc.list._IDs.length - 1 : lastIndex - 1];
            }
            zc.list._updateMapAndScroll(id);
        },
        _update2Next: function () {
            if (zc.list._lastID === null) {
                // use the first
                var id = zc.list._IDs[0];
            } else {
                var lastIndex = zc.list._IDs.indexOf(zc.list._lastID);
                // use the next one or the first one
                var id = zc.list._IDs[lastIndex === zc.list._IDs.length - 1 ? 0 : lastIndex + 1];
            }
            zc.list._updateMapAndScroll(id);
        },
        _updateMapAndScroll: function (id: number) {

            zc.list._updateMap(id);
            zc.list.item2Top(id);
        },
        _updateMap: function (id: number) {
            if (zc.list._lastID === id) {
                return;
            }
            zclog('[scroll] last id: ', zc.list._lastID)
            zc.list._lastID = id;

            zc.list._zcmap.update(id)

        },

        item2Top: function (id: number) {


            var item = zc.list._findItemToUp(id);

            if (!item) {
                zclog('[scroll] not correct item ', id);
                return;
            }

            zclog('[scroll] try ', item);

            if (xsScreen()) {
                var pos = item.offset().top - zc.list._affixEle.outerHeight(true);
                // if(pos<zc.list._beginAffixPosition) pos=zc.list._beginAffixPosition;

                $('html, body').animate({
                    scrollTop: pos
                }, 800);
            } else {
                window.scrollTo(0, item.offset().top)
            }
        },


        _side400: function (config) {
            // if (xsScreen()) return;
            var spareWidth = config.sideEle.parent().width() - 400;
            if (spareWidth > 0) {
                // side靠右
                config.sideEle.css('margin-left', spareWidth + 'px');

                zclog('[side] margin-left: ' + spareWidth);

            } else {
                zc.list._sideLess400(config);
            }
        },
        _sideLess400: function (config) {

            if (parseFloat(config.sideEle.css('margin-left')) > 0) {

                config.sideEle.css('margin-left', '');
                zclog('[side] margein left quit');

            }
        },
        _affixChildren: function (config) {
            var sideWidth = config.sideEle.width() + 'px';

            for (var ele in config.elements) {
                config.elements[ele].width(sideWidth);
            }
            zclog('[affix child] width ' + sideWidth);

        },
        _quitAffixChildren: function (config) {
            for (var ele in config.elements) {
                config.elements[ele].width('');
            }
        },

        _destroyAffix: function (config) {

            $(window).off('.affix');
            $(config.affixEle).removeData('bs.affix').removeClass('affix affix-top affix-bottom');

            zclog('[affix] clear');
        },
        _initSideAffix: function (config) {

            zclog('[affix] side set')
            var $ele = config.affixEle;


            //        bootstrap侧边固定导航
            //        当页面向下滚动了 top 长，.affix-top切换成.affix类 开始变化
            //        页面滚动到离底部距离为 bottom 时，.affix类切换成.affix-bottom
            //        http://blog.tanteng.me/2014/02/bootstrap-affix/
            // 避免地图抖动， jq给的top没计算margin-top,　30 见.affix{top:30px;}
            var pos = zc.list._beginAffixPosition = $ele.offset().top - parseInt($ele.css('marginTop')) - 30;


            $ele.affix({
                offset: {
                    top: pos,
                    bottom: function () {
                        return ($('#footer').outerHeight(true) + $('#quotes-slide').outerHeight(true) + 100); // 100 只是个概数
                    }
                }
            });


        },
        _initTopAffix: function (config) {
            zclog('[affix] top set')
            var $ele = config.affixEle;

            // 避免地图抖动， jq给的top没计算margin-top,　30 见.affix{top:30px;}
            var pos = zc.list._beginAffixPosition = $ele.offset().top - parseInt($ele.css('marginTop')) - 30;

            $ele.affix({
                offset: {
                    top: pos,
                    bottom: function () {
                        return ($('#footer').outerHeight(true) + $('#quotes-slide').outerHeight(true) + 100); // 100 只是个概数
                    }
                }
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
                free.decodeDomTrees($('.z-free'));
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

            // 先解密　因为 markdown-it 会把 __ 理解为 <strong>
            if (free.hasZcCode(content)) {
                content = free.decodeTagedStringIndependently(content);
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

getG().zc = zc;
