if (!String.prototype.trim) {
    String.prototype.trim = function () {
        return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
    };
}


/*
 *
 * free.decodeTagedHtmlStringByDom( free.encodeTagedHtmlStringByDom( md.render(editor.value() ) )  )
 *
 * 每个z-free独立保存自己的code：
 * free.decodeTagedHtmlStringByDom( free.encodeTagedHtmlStringByDom( md.render(editor.value()), true ), true  )
 * */
var free = {
    e: '\u771f'.charCodeAt(0), // 30495
    _encodeCharCode: function (code) {
        var n = code - free.e;

        if (n % 2 == 0) {
            n = n * 2;
        } else {
            n = n * 3;
        }

        n = n.toString();

        if (n.length > 6)
            console.error('free._encodeCharCode for : ' + n);

        // 左填充0 以补足6位
        n = ['', '0', '00', '000', '0000', '00000'][6 - n.length] + n;

        return n;

    },
    _decodeCharCode: function (charCode) {
        // 先去掉前面的0 再parseInt 否则 parseInt('00-231') 得到 0
        var code = parseInt(charCode.substr(charCode.lastIndexOf('0-') + 1), 10);

        if (code % 2 == 0) {
            code = code / 2;
        } else {
            code = code / 3;
        }
        return String.fromCharCode(code + free.e);

    },
    encodeText: function (text) {
        var c = [];
        for (var i = 0; i < text.length; i++) {
            c.push(free._encodeCharCode(text.charCodeAt(i)));
        }
        var code = c.join('')
        if (text == free.decodeTextCode(code)) {
            return code;
        } else {
            alert('wrong free.encodeText for ' + text);
        }

    },
    decodeTextCode: function (code) {
        var text = [], lastCharIndex = code.length - 6;
        for (var i = 0; i <= lastCharIndex; i = i + 6) {
            text.push(free._decodeCharCode(code.substr(i, 6)))
        }
        return text.join('');
    },
    _placeHolder: function (text) {
        var placeholder = '', i = text.length;
        while (i--) {
            placeholder += text.charCodeAt(i) > 255 ? '__' : '_';
        }
        return placeholder;

    },
    /**
     *
     * @param ele
     * @param codes optional,编码可在每个元素上(independent)，也可在codes里面
     * @private
     */
    _decodeDomTree: function (ele, codes) {
        var freeTags = ele.getElementsByTagName(free.tag);
        if (!freeTags) {
            return;
        }
        if (typeof(codes) == 'string')
            codes = codes.split('+');

        var freeEle, indexNotDependent = -1, code;
        for (var i = 0, len = freeTags.length; i < len; i++) {
            freeEle = freeTags[i];
            // 如果有 data-c，就是独立编码，不需要从 codes中寻找
            if (freeEle.hasAttribute('data-c')) {
                freeEle.textContent = free.decodeTextCode(ele.getAttribute('data-c'));
                freeEle.removeAttribute('data-c');
            } else {
                indexNotDependent++;
                if (freeEle.hasAttribute('data-i')) {
                    code = codes[parseInt(freeEle.getAttribute('data-i'))];
                    freeEle.removeAttribute('data-i');
                } else {
                    code = codes[indexNotDependent];
                }
            }
            freeEle.textContent = free.decodeTextCode(code)
        }


    },
    // 公共编码存在每个tree的最后一个子元素上
    decodeDomTrees: function ($eles) {
        $eles.each(function () {
            var codes = null;
            if (this.lastElementChild.hasAttribute('data-c'))
                codes = this.lastElementChild.getAttribute('data-c')
            free._decodeDomTree(this, codes);
        })
    }
    ,

    /**
     * 每个tag的code存到自己身上
     *
     * test:
     * free.encodeTagedStringIndependently('<z-free>6</z-free><z-free >87</z-free><z-free ok="3" >6</z-free>')
     */
    encodeTagedStringIndependently: function (rawStr) {
        var encoded = rawStr.replace(/<z-free(.*?)>(.+?)<\/z-free>/g, function (match, attris, text) {
            return '<z-free data-c="' + free.encodeText(text) + '"' + attris + '>' + free._placeHolder(text) + '</z-free>';
        });
        var restored = free.decodeTagedStringIndependently(encoded);
        if (restored == rawStr) {
            return encoded;
        } else {
            console.error('free.encodeTagedStringIndependently ');
            console.log('origin: ', rawStr);
            console.log('restored: ', restored);
            console.log('recoded : ', encoded);
        }

    }
    ,
    decodeTagedStringIndependently: function (codedStr) {
        return codedStr.replace(/<z-free data-c="(\S+)"(.*?)>.+?<\/z-free>/g, function (match, code, attris) {
            return '<z-free' + attris + '>' + free.decodeTextCode(code) + '</z-free>';
        });

    }
    ,
    /**
     *
     * 所有tag的code都放到一个字符串里面
     *
     * test:
     * free.encodeTagedString('<z-free en="oky ">6</z-free>')
     * free.encodeTagedString('等到<z-free en=" gunshot rang out">枪响</z-free>。黄渝拿「<z-free en=" June_F Green Card">绿卡</z-free>」我')
     * free.encodeTagedString('<z-free es="oky ">6</z-free>a<z-free>8</z-free>aaaa<z-free>6</z-free>')
     */
    encodeTagedString: function (rawStr) {

        var all_codes = [], currentCode, currentCodeIndex = 0, tagIndex = -1;
        var encoded = rawStr.replace(/<z-free(?: (en|es|ru)="([^"]+?)")?(.*?)>(.+?)<\/z-free>/g, function (match, lang, alt, attris, text) {
            tagIndex++;


            currentCode = free.encodeText(text);
            currentCodeIndex = all_codes.indexOf(currentCode);

            if (currentCodeIndex == -1) {
                all_codes.push(currentCode);
                currentCodeIndex = all_codes.length - 1;
            }

            var placeHolderText = alt || free._placeHolder(text);

            var langAttri = '';
            if (alt && lang) {
                langAttri = ' lang="' + lang + '"'
            }

            if (currentCodeIndex != tagIndex) {
                return '<z-free' + langAttri + ' data-i="' + currentCodeIndex + '"' + attris + '>' + placeHolderText + '</z-free>';
            }
            return '<z-free' + langAttri + attris + '>' + placeHolderText + '</z-free>';
        });


        var codes = all_codes.join('+');
        var restored = this.decodeTagedString(encoded, codes);
        if (restored == rawStr) {
            return {
                s: encoded,
                codes: codes
            }
        } else {
            console.error('free.encodeTagedString');
            console.log('origin: ', rawStr);
            console.log('restored: ', restored);
            console.log('recoded : ', encoded);
        }

    }
    ,
    decodeTagedString: function (codedStr, codes) {

        codes = codes.split('+');
        var tagIndex = -1;
        return codedStr.replace(/<z-free(?: lang="(en|es)")?(?: data-i="(\w+?)")?(.*?)>(.+?)<\/z-free>/g, function (match, lang, codeIndex, attris, alt) {
            codeIndex = codeIndex || ++tagIndex;
            if (lang) {
                return '<z-free ' + lang + '="' + alt + '"' + attris + '>' + free.decodeTextCode(codes[codeIndex]) + '</z-free>';
            } else {
                return '<z-free' + attris + '>' + free.decodeTextCode(codes[codeIndex]) + '</z-free>';
            }
        })
    },
    hasZcCode: function (s) {
        return s && s.indexOf('<' + free.tag) > -1;
    }
}

free.tag = free.decodeTextCode("-91119-60900-91179-91143-60788-60788"); //  'z-free'

var g;
if (typeof window !== "undefined") {
    g = window
} else if (typeof global !== "undefined") {
    g = global
} else if (typeof self !== "undefined") {
    g = self
} else {
    g = this
}

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

            return zc.editor._md = g.getMDParser();
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
    _debug: true,
    log: function () {
        if (zc._debug)
            window['console'] && console.log.apply(null, arguments)
    },

    /**
     // 能力：让各组函数顺序执行 不精深 目前似乎也没啥用处 但不排除日后可能有些函数有先后要求
     // 特征：_pool里一个key储存相关的一组函数，控制级别是组；未来可将 delay, runEnterNow 等功能分配到各个函数上 定制能力细化到函数级别

     level: 数字越小越优先

     callback分两类，resize和enter:
     * 屏幕大变，只运行enter函数，不会运行resize函数
     * _timerID 也是为两者分别存储，意味着，resize会覆盖前面的resize，但不覆盖前面的enter.
     *    之前只设了一个id，导致屏幕变 xs 时，enterXsCallback没有执行，被后面的 xsResizeCallback 覆盖了。在chrome上，屏幕变，不知道为什么连续产生了两个resize事件
     */
    workAccordingScreen: {

        _lastScreenIsXs: null,
        _configPool: {},
        // 按照运行顺序储存 如 ['100 scroll', '90 mouse','  10 affix ']
        _order: [],
        _inited: false,
        init: function () {
            if (this._inited) return;
            this._inited = true;

            zc.log('[screen] init ');
            var me = zc.workAccordingScreen;
            me._lastScreenIsXs = zc.tool.xsScreen();


            $(window).resize(function () {
                var i;
                var xs = zc.tool.xsScreen();


                // 屏幕未大变
                if (me._lastScreenIsXs === zc.tool.xsScreen()) {
                    if (xs) {
                        me._run('xsResizeCallback')
                    } else {
                        me._run('bigResizeCallback')
                    }
                    return;
                }

                // 屏幕大变
                me._lastScreenIsXs = xs;
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
                zc.log('[screen] clear timeout for ' + bigType);
            }

            me._timerID[bigType] = setTimeout(function () {
                var len = me._order.length;
                var currentKey;
                for (var i = 0; i < len; i++) {
                    currentKey = me._order[i];
                    if (me._configPool[currentKey][whichType]) {
                        zc.log('[screen] run ' + whichType + ': ' + currentKey);
                        me._configPool[currentKey][whichType](me._configPool[currentKey]);
                    }
                }
            }, 220);

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
            zc.log('[screen] add: ' + key);
            if (config.runEnterNow) {
                var i;
                if (zc.tool.xsScreen()) {
                    config.enterXsCallback && config.enterXsCallback(config);
                } else {
                    config.enterBigCallback && config.enterBigCallback(config);
                }

            }
            if (config.runResizeNow) {
                if (zc.tool.xsScreen()) {
                    config.xsResizeCallback && config.xsResizeCallback(config);
                } else {
                    config.bigResizeCallback && config.bigResizeCallback(config);
                }

            }
        },
    },
    tool: {
        xsScreen: function () {
            return $('#me').css('opacity') == "0.99";
        },
        notXsScreen: function () {
            return !this.xsScreen();
        },
    },
    list: {
        _zcmap: null,
        _IDs: null,
        _lastID: null,
        _lastScreenIsXs: null,


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
                    ele: opts.infoEle,
                    data: opts.infoData,
                    infoSwipeBox: false, // 不需要ZCMap提供的swipe 自定义swipe
                }
            )


            // 根据窗口滚动 map 高亮屏幕上的第一个title
            // update map red plot according to the first article h1 title on screen
            // 显示标准是viewport第一个标题，所以bootstrap的 scrollspy不适合
            zc.elementsSpy.init(opts.listArea + ' ' + opts.spyTarget, opts.spyTargetAttrWithPlotID || 'id')
            zc.elementsSpy.addDo(function lightViewTopH1(id, lastId) {
                zc.list._updateSideMap(id)
            });


            zc.workAccordingScreen.init();

            // 实现靠右，用动态的 margin-left，而非浮动、绝对定位，是因为 affix
            zc.workAccordingScreen.add({
                name: 'side_400px',
                level: 5,
                runEnterNow: true,

                sideEle: $('#side'),
                bigResizeCallback: zc.list.side400,
                enterBigCallback: zc.list.side400,
                enterXsCallback: zc.list.sideLess400,
            });

            // 在 chrome 59 中发现 ，被 .affix 的元素 如果其中的子元素没有确定width 会导致这些元素被长内容撑得非常长；
            // 在firefox 53 中也有类似问题，但撑得不太长
            // 解决：给定一个width
            zc.workAccordingScreen.add({
                name: 'affix_children',
                level: 6, // it must be after 'side_400px' because the children width depends #side
                runEnterNow: true,

                sideEle: $('#side'),
                elements: [$(opts.affix), $('#LMap-info')],

                bigResizeCallback: zc.list.affixChildren,
                enterBigCallback: zc.list.affixChildren,
                enterXsCallback: zc.list.quitAffixChildren,
            });

            zc.workAccordingScreen.add({
                name: 'affix',
                level: 6,
                runEnterNow: true,

                affixEle: $(opts.affix),

                // 为什么小屏幕也做个affix？利用grid实现图片居上很简单 但因为bug affix不能用在pull push的column中
                // https://getbootstrap.com/docs/3.3/css/#grid-column-ordering
                enterBigCallback: zc.list.initSideAffix,
                enterXsCallback: zc.list.initTopAffix,

            });

            zc.workAccordingScreen.add({
                name: 'big_monitor_h1',
                level: 7,
                runEnterNow: true,
                enterBigCallback: function () {
                    zc.log('[moniter h1] start')
                    zc.elementsSpy.addEventHandler();
                },
                enterXsCallback: function () {
                    zc.elementsSpy.removeEventHandler();
                    zc.log('[moniter h1] stop')
                },

            });

            // zc.workAccordingScreen.add({
            //     name: 'xs_list_scroll',
            //     level: 7,
            //     runEnterNow: true,
            //     enterXsCallback: function () {
            //         zc.log('[list scroll] start')
            //         zc.listScroll.init(opts.listArea, opts.findItemWay);
            //     },
            //     enterBigCallback: function () {
            //         zc.listScroll.destroy();
            //         zc.log('[list scroll] stop')
            //     },
            // });


            zc.workAccordingScreen.add({
                name: 'xs_wipe_info',
                level: 8,
                runEnterNow: true,
                enterXsCallback: function () {
                    zc.log('[map info] make swipe')
                    $(opts.infoSwipeBox).swipe({
                        swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                            if (direction == 'left') {
                                zc.list._update2Down();
                            } else if (direction == 'right') {
                                zc.list._update2Up();
                            }
                        },
                        //Default is 75px,
                        threshold: 40
                    });

                },
                enterBigCallback: function () {
                    zc.log('[map info] end swipe')
                    $(opts.infoSwipeBox).swipe('destroy');
                },
            });

            // 根据鼠标动作  map 高亮鼠标下的 article
            // 鼠标进入目标区域后 即停止 上面的 zc.elementsSpy
            $(opts.listArea).mouseenter(function (e) {
                zc.elementsSpy.disable();
            }).mouseleave(function (e) {
                zc.elementsSpy.enable();
            }).mouseover(function (e) {
                var id = $(e.target).closest(opts.spyItem, this).find(opts.spyTarget).attr(opts.spyTargetAttrWithPlotID);
                // 发现 #L 有两侧padding 进入padding是找不到合适 article的 这时 id 为 undefined
                if (!id) {
                    return
                }
                zc.list._updateSideMap(id)
            })

            if (zc.tool.xsScreen()) {
                // 单纯高亮第一个 h1 但不注册相关spy事件
                zc.list._updateSideMap(zc.elementsSpy.getFirstVisibleH1ID());
            }


        },
        _updateSideMap: function (id) {
            if (zc.list._lastID === id) {
                return;
            }
            zc.list._lastID = id;

            zc.list._zcmap.update(id)

        },
        _update2Up: function () {
            var id = zc.list._IDs[parseInt(zc.list._IDs.indexOf(zc.list._lastID)) - 1];
            zc.list._updateSideMap(id);
            zc.listScroll.item2Top(id);
        },
        _update2Down: function () {
            var plus = zc.list._IDs.indexOf(zc.list._lastID) + 1;
            var id = zc.list._IDs[plus == zc.list._IDs.length ? 0 : plus];
            zc.list._updateSideMap(id);
            zc.listScroll.item2Top(id);
        },


        side400: function (config) {
            // if (zc.tool.xsScreen()) return;
            var spareWidth = config.sideEle.parent().width() - 400;
            if (spareWidth > 0) {
                // side靠右
                config.sideEle.css('margin-left', spareWidth + 'px');

                zc.log('[side] margin-left: ' + spareWidth);

            } else {
                zc.list.sideLess400(config);
            }
        },
        sideLess400: function (config) {

            if (parseFloat(config.sideEle.css('margin-left')) > 0) {

                config.sideEle.css('margin-left', '');
                zc.log('[side] margein left quit');

            }
        },
        affixChildren: function (config) {
            var sideWidth = config.sideEle.width() + 'px';

            for (var ele in config.elements) {
                config.elements[ele].width(sideWidth);
            }

        },
        quitAffixChildren: function (config) {
            for (var ele in config.elements) {
                config.elements[ele].width('');
            }
        },

        destroySideAffix: function (config) {

            $(window).off('.affix');
            $(config.affixEle).removeData('bs.affix').removeClass('affix affix-top affix-bottom');

            zc.log('[affix] end');
        },
        initSideAffix: function (config) {
            zc.log('[affix] side start')
            var $ele = config.affixEle;


            //        bootstrap侧边固定导航
            //        当页面向下滚动了 top 长，.affix-top切换成.affix类 开始变化
            //        页面滚动到离底部距离为 bottom 时，.affix类切换成.affix-bottom
            //        http://blog.tanteng.me/2014/02/bootstrap-affix/
            $ele.affix({
                offset: {
                    top: $ele.offset().top - parseInt($ele.css('marginTop')) - 30, // 避免地图抖动， jq给的top没计算margin-top,　30 见.affix{top:30px;}
                    bottom: function () {
                        return ($('#footer').outerHeight(true) + $('#quotes-slide').outerHeight(true) + 100); // 100 只是个概数
                    }
                }
            });


        },
        initTopAffix: function (config) {
            zc.list.destroySideAffix(config);
            zc.log('[affix] top start')
            var $ele = config.affixEle;

            $ele.affix({
                offset: {
                    top: 0,
                    bottom: function () {
                        return ($('#footer').outerHeight(true) + $('#quotes-slide').outerHeight(true) + 100); // 100 只是个概数
                    }
                }
            });


        },

    },
    listScroll: {
        _listBox: null,
        /*
        **  return a jquery instance
         */
        _findItemWay: null,
        _enable: false,
        init: function (query, findItemWay) {
            this._listBox = $(query);
            this._listBox.perfectScrollbar();
            this._findItemWay = findItemWay;
            this._enalbe = true;

        },
        item2Top: function (id) {
            if (!this._enalbe) return;

            var item = this._findItemWay(id, this._listBox);
            if (item) {
                // this._listBox[0].scrollTop = item[0].offsetTop;
                this._listBox.animate({scrollTop: item[0].offsetTop}, 800);
            }
            else
                console.debug('item2top not correct item ', id, item);
        },
        update: function () {
            this._listBox.perfectScrollbar('update');
        },
        destroy: function () {
            this._listBox && this._listBox.perfectScrollbar('destroy');
            this._enalbe = false;
        },
    },
    // 不断定位显示在屏幕最上方的目标元素 对元素或元素的id进行操作
    elementsSpy: {
        // 这类回调两个参数：当前id 上回id
        _H1Does: [],
        // 这类回调的特色是：参数不是id 而是元素
        _H1EleDoes: [],
        _H1List: [],
        _H1Query: '',
        _attrWithID: '',
        _lastH1: null,
        updateH1s: function (query) {
            //todo 如果列表变化，这个变量也需要更新
            this._H1Query = query;
            return this._H1List = $(this._H1Query);
        },
        _inited: false,
        // 用处：鼠标起作用时，这里就不用起作用了
        _enalbe: true,
        getFirstVisibleH1: function () {
            var h1;
            this._H1List.each(function (index, element) {
                if (zc.viewport.fullyVisible(this.getBoundingClientRect())) {
                    h1 = this;
                    return false;
                }
            });
            return h1;

        },
        getFirstVisibleH1ID: function () {
            var h1 = this.getFirstVisibleH1();
            if (h1) {
                return h1.getAttribute(this._attrWithID)
            }
        },
        init: function (query, attrWithID) {

            if (this._inited) return;
            this._inited = true;
            this._enalbe = true; // 可能会被这个鼠标事件改变，故宽屏初始化时确定为 true : $(opts.listArea).mouseenter

            this._attrWithID = attrWithID || 'id';

            this.updateH1s(query);
        },
        _timer: null,
        _handler: function () {

            var me = zc.elementsSpy;

            if (me._timer) window.clearTimeout(me._timer)

            if (me._enalbe) {
                me._timer = setTimeout(function () {
                    var topH1 = me.getFirstVisibleH1();
                    if (topH1) {

                        // zc.log('Found h1 id: ', this.id)

                        var topEleID = topH1.getAttribute(me._attrWithID);
                        if (topEleID == zc.list._lastID) return false;

                        ZCMap.log(' elementSpy try to do for id: ', topEleID)

                        for (var i in me._H1Does) {
                            me._H1Does[i](topEleID, zc.list._lastID);
                        }
                        for (var i in me._H1EleDoes) {
                            me._H1EleDoes[i](topH1, me._lastH1);
                        }

                        me._lastH1 = topH1;

                    }
                }, 400)
            }
        },
        addEventHandler: function () {

            /*
             关于事件捕捉　
             -　见：　http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport/7557433#7557433
             -　还不完美　如　We can't catch zoom/pinch event yet
             */

            // DOM load 这种事件，可让函数马上运行一遍
            $(window).on('DOMContentLoaded load resize scroll', this._handler);
        },
        removeEventHandler: function () {
            $(window).off('DOMContentLoaded load resize scroll', this._handler);
        },
        addDo: function (doWhat) {

            this._H1Does.push(doWhat);

        },
        addEleDo: function (doWhat) {

            this._H1EleDoes.push(doWhat);

        },
        enable: function () {
            this._enalbe = true;
        },
        disable: function () {
            this._enalbe = false;
        },
    },
    content: {
        _inited: false,
        init: function () {
            if (this._inited) return;
            this._inited = true;

            this._renderMDElement();
            this._bigHref();
            free.decodeDomTrees($('.z-free'));
            this._socialLink();
            this.oneLineHeight();
        },

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
        },
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
                    zc.log('scroll ', button.offset().top - button_top_distance)
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
                    return zc.viewport.anyVisible(container[0].getBoundingClientRect()) && !zc.viewport.fullyVisible(button[0].getBoundingClientRect())
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
        },
        _socialLink: function () {
            $('z-wechat').replaceWith(function (index, old) {

                if ($(this).attr('parsed')) return old;

                return ['<a target="_blank" href="http://weixin.sogou.com/weixin?type=1&query=',
                    this.textContent,
                    '">',
                    this.title ? this.title + ' ' : '',
                    , '<mark parsed="true">', this.textContent, '</mark></a>'].join('');
            });
        },

        _bigHref: function () {
            $('.Big-Href').click(function () {
                $(this).find('a')[0].click();
                // if(!$(this).data('a')){
                //     $(this).data('a', $(this).find('a')[0]) );
                // }
                // $(this).data('a').click();
            })
        },
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

        },
        _renderMDElement: function () {
            // 解密
            $('.md-code').each(function () {
                var html = zc.content.renderMD(this.textContent);
                // // 避免文章正文和后记的引用冲突
                // if(this.dataset.mdFnPrefix && html.indexOf('#fn')!=-1){
                //     zc.log('renderMD: change footnote prefix')
                //     var prefix = this.dataset.mdFnPrefix;
                //     html = html.replace(/<a href="#fn/g,'<a href="#'+prefix)
                //         .replace(/ id="fn/g,' id="'+prefix);
                // }
                this.innerHTML = html;
            })
        },


    },
}

// viewport
!function () {

    /*
     * 特点
     * - 使用了api getBoundingClientRect   还有一个思路是用$element.offset()和$(window).scrollTop()之类
     * - 根据zc网站的需要　只实现了y轴　未考虑x轴
     * - http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport/7557433#7557433
     */
    zc.viewport = {
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

    zc.viewportTest = function (el) {
        if (typeof jQuery !== 'undefined' && el instanceof jQuery) el = el[0];
        var rect = el.getBoundingClientRect();
        for (var i in zc.viewport) {
            i && zc.log(i, zc.viewport[i](rect))
        }
    }

}();

/*
*
 *
 */
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
        zc.log('[map] zoom:', level, '; plot size will be ', me.config.plotSize * b);
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
    zc.log('[map] start special mode', 'left')
}
ZCMap.prototype.enterRight = function () {
    this._mode_status = 'right';
    zc.log('[map] start special mode', 'right')
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
        zc.log('[map] to active plot :', nextActivePlotID, '; deactive:', this.lastActivePlot)

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
        zc.log('[map] sideMap Info not found id ', id, ' in ', infoData);
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
