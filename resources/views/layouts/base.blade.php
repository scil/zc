<!DOCTYPE html>
<html lang="{!! $LOCALE==='zh'? 'zh-cmn-Hans':'en' !!}">
<head>
    <meta charset="utf-8">
    <title>{!! $title !!}</title>
    <meta name="description" content="{!! $desc !!}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/vendor.css" rel="stylesheet">

    @if($LOCALE==='zh')
        <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js" defer></script>
        <script src="data:text/javascript;base64, aWYoIXdpbmRvdy5qUXVlcnkpe3ZhciBoPWRvY3VtZW50LmhlYWQsZj0iLy9jZG4uanNkZWxpdnIubmV0L25wbS8iLGU9Ii5taW4uanMiLGo9ImpxdWVyeSIsYj0iYm9vdHN0cmFwIixyPSJyYXBoYWVsIix1PVtmK2orIkAzLjMuMS9kaXN0LyIraitlXSx1Mj1bZitiKyItc2Fzc0AzLjMuNy9hc3NldHMvamF2YXNjcmlwdHMvIitiK2UsZityKyJAMi4yLjcvIityK2VdLHE9Ij9zPTQiLHUzPVsiL2pzL3ZlbmRvci5qcyIrcSwiL2pzL2FwcC5qcyIrcV07ZnVuY3Rpb24geihuKXtmb3IoaSBpbiBuKXM9ZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgic2NyaXB0Iikscy5zcmM9bltpXSxoLmluc2VydEJlZm9yZShzLGguZmlyc3RDaGlsZCl9ZnVuY3Rpb24gdChuKXtzLm9ubG9hZD1mdW5jdGlvbigpe3NldFRpbWVvdXQobiwzMDApfX16KHUpLHQoZnVuY3Rpb24oKXt6KHUyKSx0KGZ1bmN0aW9uKCl7eih1MyksdChmdW5jdGlvbigpe3dpbmRvdy5kZXBlbmRlbnRfZnVuYyYmZGVwZW5kZW50X2Z1bmMoKX0pfSl9KX0=
" defer></script>

        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" defer></script>
        <script src="https://cdn.bootcss.com/raphael/2.2.7/raphael.min.js" defer></script>
    @else
        <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
        <![endif]-->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js" defer></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap-sass@3.3.7/assets/javascripts/bootstrap.min.js"
                defer></script>
        <script src="https://cdn.jsdelivr.net/npm/raphael@2.2.7/raphael.min.js" defer></script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/pjax/pjax.min.js" defer></script>
    <script src="/js/vendor.js" defer></script>
    <script src="/js/app.js" defer id="LAST-SCRIPT"></script>
    <script type="text/javascript">LOCALE = '{!! $LOCALE !!}';
        G_conten_func_pool = [];
        G_conten_1_func_pool = [];</script>

    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-icon.png">
</head>
<body>

<nav class="navbar navbar-inverse" id="navbar">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse">
                <span class="sr-only"
                      data-locale-names='[{"en":"Toggle navigation","zh":"导航"}]'>{!! $LOCALE==='zh'?'导航':'Toggle navigation' !!}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{--<a class="navbar-brand" href="/">真城</a>--}}
            <a id="logo" class="navbar-brand" href="{!! $LOCALE==='zh'?'/':'/en' !!}">
                <img src="/img/org/zc_logo.png" alt="Zhen"/>
            </a>

            {{-- 总是显示的内容？小屏幕时不收缩？可放这里　nav可考虑用nav-pills --}}
            {{--<ul class="navbar-always-show"></ul>--}}
        </div>

        {{-- .navbar-collapse 小屏幕时收缩的部分 --}}
        <div id="navbar-collapse" class="collapse navbar-collapse">

            @include('partials.columns._navbar-nav-left-'.$LOCALE)

            <ul class="nav navbar-nav navbar-right">
                <li id="jiayucun-li" class="hidden"><a href="#">{!! $LOCALE==='zh'?'贾鱼村':'Hamlet Hamlet' !!}</a></li>
                @if(empty($user))
                    <li><a id="pass-li"
                           data-locale-names='[{"en":"Pass","zh":"山关"}]'>{!! $LOCALE==='zh'?'山关':'Pass' !!}</a></li>
                    <style> #select-lang {
                            padding-left: 3px;
                            font-size: 14px;
                            letter-spacing: 0.5px;
                        }

                        .demo_select_lang {
                            color: red !important;
                        }
                    </style>
                    <li><a id="select-lang"
                           data-locale="{!! $LOCALE==='zh'?'en':'zh' !!}">{!! $LOCALE==='zh'?'EN':'中' !!}</a></li>


                @else
                    <?php
                    echo <<<M
                    <li class="dropdown" >
    <a href = "#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">username
    <ul class="dropdown-menu" role="menu" >
    <li><a href="#"> 退出</a></li>
    <li><a href="#"> 收藏 </a></li>
    </ul>
    </li>
M;

                    ?>
                @endif
            </ul>
            {{--搜索框--}}
            {{--小屏幕只显示个图标，点击放大，其它地方缩小或隐藏部分--}}
            {{--<form class="navbar-form navbar-right" role="search">--}}
            {{--<div class="form-group">--}}
            {{--<span class="glyphicon glyphicon-search" aria-hidden="true"></span>--}}
            {{--<input type="text" class="form-control" placeholder="Search">--}}
            {{--</div>--}}
            {{--<button type="submit" class="btn btn-default">Submit</button>--}}
            {{--</form>--}}

        </div>
        {{-- .navbar-collapse --}}
    </div>
    {{-- .container-fluid --}}
</nav>

<header>
    <div id="header" class="container">
        {!! ZC_HEADERS[$LOCALE][$columnID] !!}
        <hr id="header-hr"/>
    </div>
</header>

<div class="container pjax">
    @yield('content_top')
</div>

<div class="pjax">
    @yield('content')
</div>

<footer id="footer">
    <div class="container">
        <hr>
        <div class="row" id="footer-first-row">
            <div class="col-xs-6">
                <p class="pull-left heiti" id="me">{!! $LOCALE==='zh'?'真':'Zhen' !!}</p>
            </div>
            <div class="col-xs-6">
                <ul id="contacts" class="nav nav-pills pull-right">
                    <li>
                        <a target="_blank" href="http://weibo.com/zhencorg">
                            {{--<i class="contact-icon icon-gplus"></i>--}}
                            <i class="fa fa-weibo"></i>
                        </a>
                    </li>
                    {{--<li>--}}
                    {{--<a href="javascript:$('#wechatModal').modal();void(0)">--}}
                    {{--<i class="contact-icon icon-github-circled"></i>--}}
                    {{--<i class="fa fa-weixin"></i>--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                    {{--<a href="">--}}
                    {{--<i class="contact-icon icon-wechat"></i>--}}
                    {{--<i class="fa  fa-github"></i>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                </ul>
            </div>


        </div>
        <p id="copyright">{!! $LOCALE==='zh'?'真城，山水之城。':'Zhen, the city of Zhen.' !!}</p>
    </div>
</footer>

<!-- wechat Modal -->
{{--<div class="modal fade" id="wechatModal" tabindex="-1" role="dialog" aria-labelledby="wechatModalLabel">--}}
{{--<div class="modal-dialog" role="document">--}}
{{--<div class="modal-content" style="max-width:400px;text-align: center">--}}
{{--<div class="modal-header">--}}
{{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>--}}
{{--</button>--}}
{{--<h4 class="modal-title">真城联系微信</h4></div>--}}
{{--<div class="modal-body">--}}
{{--<div class="">--}}
{{--<img class="center-block" src="/img/org/wechat_结巢人境.jpg" alt="微信号：结巢人境">--}}
{{--<p style="margin-top:1em;">微信号：结巢人境</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="modal-footer">--}}
{{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}


<div class="pjax">
    @yield('bottom')
</div>

<script>

    window.standalone_func && standalone_func();

    function open_gate() {
        return true;
    }

    document.getElementById('pass-li').href = '/' + (open_gate() ? 'pass' : 'ferry');

    if (location.pathname.substr(1, 4) === 'sail' || location.host.substr(0, 4) === 'sail') {
        document.getElementById('me').innerHTML = LOCALE === 'zh' ? '真城 · 越海' : 'Zhen · Sailing';
    }

    var last_script = document.getElementById('LAST-SCRIPT'),
        last_script_done = false;


    function select_lang() {
        $ui = $('#select-lang');
        // use 'en/' instead of 'en', avoid some urls like '/enjoy'
        if (location.pathname.substr(1, 3) === LOCALE + '/' || location.pathname.substr(1, 2) === LOCALE) {
            // pathname without locale
            var cleanpath = location.pathname.substr(3);
        } else {
            // pathname without locale for zh
            var cleanpath = location.pathname;
        }

        var target = $ui.attr('data-locale');
        if (target === LOCALE) return;

        if (target === 'zh') {
            // add '?' to prevent pjax cache for root url 'zhenc.test/'
            url = cleanpath === '' ? '/?' : cleanpath;
        }
        else {
            url = '/' + target + cleanpath;
        }

        console.log('another lang url is',url)
        $ui.attr('href', url);

        // why? do not use pjax
        $ui.click(function () {
            location.href = this.href;
            return false;
        });

        function demo_select_lang(locale) {
            // 不用 cache，因为 pjax 会刷新
            var to_change = $('#header-nav [data-locale-names],#navbar [data-locale-names]');
            to_change.each(function (i, ele) {
                $(ele).text($(ele).data('locale-names')[0][locale]);
            });
            if (locale === LOCALE) to_change.removeClass('demo_select_lang');
            else to_change.addClass('demo_select_lang');
        }

        $ui.mouseenter(function () {
            demo_select_lang(target)
        })
            .mouseleave(function () {
                demo_select_lang(LOCALE)
            });

    }

    G_conten_1_func_pool.push(select_lang)

    old_dependent_func = window.dependent_func && dependent_func;

    /**
     *
     * @param all {boolean} if run functions in G_content_1_func_pool which not run when pjax.success
     */
    function run_all_dependent_func(all) {
        for (var i_in_pool in G_conten_func_pool) {
            G_conten_func_pool[i_in_pool]();
        }
        if (all) {
            for (var i_in_pool in G_conten_1_func_pool) {
                G_conten_1_func_pool[i_in_pool]();
            }

        }
        old_dependent_func && old_dependent_func();
    }

    // https://stackoverflow.com/questions/4845762/onload-handler-for-script-tag-in-internet-explorer
    last_script.onload = last_script.onreadystatechange = function () {

        if (!last_script_done && (!this.readyState ||
            this.readyState === "loaded" || this.readyState === "complete")) {

            last_script_done = true;


            // Pjax.prototype.getElements = function () {
            //     var elements = [];
            //     for (var i of document.links) {
            //         if( i.getAttribute('href').substr(0,1)==='/' ){
            //             elements.push(i)
            //         }
            //     }
            //     return elements;
            // }
            var pjax = new Pjax({
                // elements: "a", // default is "a[href], form[action]"
                selectors: ["title", ".pjax",],
                cacheBust: false,
                analytics: false,
            });


            run_all_dependent_func(true);

            document.addEventListener("pjax:success", function () {
                window.standalone_func && standalone_func();
                run_all_dependent_func();

                // sometime dropdown not work on weixin, why
                // $('.dropdown-toggle',$('#item-no')).dropdown()

                console.log('pjax success');
            });

            // Handle memory leak in IE
            last_script.onload = last_script.onreadystatechange = null;

        }

    }
    //# sourceURL=zc_gate
</script>
</body>
</html>
