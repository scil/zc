<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    {{-- 移动前端不得不了解的html5 head 头标签 http://blog.csdn.net/huang100qi/article/details/42596799 --}}
    <meta charset="utf-8">
    <title>{!! $title !!}</title>
    <meta name="description" content="{!! $desc !!}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta http-equiv="Cache-Control" content="max-age=172800"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/vendor.css" rel="stylesheet">
    {{--<link href="/css/all.css" rel="stylesheet">--}}

    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/raphael/2.2.7/raphael.min.js" async></script>
    <script src="/js/vendor.js" defer></script>
    <script src="/js/app.js" async id="LAST-SCRIPT"></script>

    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-icon.png">
</head>
<body>

<nav class="navbar navbar-inverse" id="navbar">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse">
                <span class="sr-only">导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{--<a class="navbar-brand" href="/">真城</a>--}}
            <a id="logo" class="navbar-brand" href="/">
                <img src="/img/org/zc_logo.png" alt="真城"/>
            </a>

            {{-- 总是显示的内容？小屏幕时不收缩？可放这里　nav可考虑用nav-pills --}}
            {{--<ul class="navbar-always-show"></ul>--}}
        </div>

        {{-- .navbar-collapse 小屏幕时收缩的部分 --}}
        <div id="navbar-collapse" class="collapse navbar-collapse">

            @include('partials.columns._navbar-nav-left')

            <ul class="nav navbar-nav navbar-right">
                <li id="jiayucun-li" class="hidden"><a href="#">假雨村</a></li>
                <?php
                if (empty($user)) {
                    echo <<<N
                <li><a id="pass-li">山关</a></li>
N;
                } else {
                    echo <<<M
                    <li class="dropdown" >
    <a href = "#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">username
    <ul class="dropdown-menu" role="menu" >
    <li><a href="#"> 退出</a></li>
    <li><a href="#"> 收藏 </a></li>
    </ul>
    </li>
M;
                }
                ?>
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
        {!! ZC_HEADERS[$columnID] !!}
        <hr id="header-hr"/>
    </div>
</header>

<div class="container">
    @yield('content_top')
</div>

@yield('content')

<footer id="footer">
    <div class="container">
        <hr>
        <div class="row" id="footer-first-row">
            <div class="col-xs-6">
                <p class="pull-left heiti" id="me">真城</p>
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
        <p id="copyright">All rights reserved.</p>
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



@yield('bottom')
<script>
    function open_gate() {
        return false;
    }

    document.getElementById('pass-li').href = '/' + (open_gate() ? 'pass' : 'ferry');

    if (location.pathname.substr(1, 4) === 'sail' || location.host.substr(0, 4) === 'sail') {
        document.getElementById('me').innerHTML = '真城 · 越海';
    }

    var wait_lib_timer = null;
    var wait_lib_times = 0;

    function wait_lib() {
        ++wait_lib_times;
        if (typeof(Raphael) === 'undefined') {
            if (wait_lib_times >= 5) {
                clearInterval(wait_lib_timer)
                console.error('lib loaded failed ')
            }
        } else {
            safe_func();
            clearInterval(wait_lib_timer)
        }
    }

    var script = document.getElementById('LAST-SCRIPT'),
        script_done = false;

    // https://stackoverflow.com/questions/4845762/onload-handler-for-script-tag-in-internet-explorer
    script.onload = script.onreadystatechange = function () {

        if (!script_done && (!this.readyState ||
            this.readyState === "loaded" || this.readyState === "complete")) {

            script_done = true;

            // Handle memory leak in IE
            script.onload = script.onreadystatechange = null;

            if (typeof(safe_func) === "function") {
                if (typeof(Raphael) === 'undefined') wait_lib_timer = setInterval(wait_lib, 100)
                else safe_func();
            }
        }

    }
    //# sourceURL=zc_gate
</script>
</body>
</html>
