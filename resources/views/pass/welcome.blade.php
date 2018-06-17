@extends('layouts.columns._welcome')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="first-page first-page-middle" id="people-first-page">

                    <div class="row">
                        <div class="col-sm-5 col-xs-12 col-sm-push-7">
                            <form class="form-horizontal" id="form-code">
                                <div class="form-group">
                                    <div class="col-md-offset-1 col-md-9 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                        <input type="email" class="form-control" id="input-code" placeholder="邀请码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-1 col-md-9 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                        <button type="submit" class="btn btn-warning btn-block" id="login-btn">开始访问
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="col-sm-7 col-xs-12 col-sm-pull-5">
                            <div id="portal-intro" class="yilu-firstpage-text">
                                    <ul class="nav nav-pills invisible" role="tablist" id="yilu-portal-tabs">
                                        <li role="presentation" class="active"><a href="#yilu-portal-1" aria-controls="home" role="tab"
                                                                                  data-toggle="tab"></a></li>
                                        <li role="presentation"><a href="#yilu-portal-2" aria-controls="profile" role="tab"
                                                                   data-toggle="tab"></a></li>
                                    </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active">
                                        <p>
                                         欢迎每一位心有灵犀一点通的朋友。真城是一个城邦，以价值观为基础，通过<span title="《真城章程》">邀请制和明规则</span>组建的城邦。</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="yilu-portal-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="container columns text-center heiti hide" id="map">
        <h2 class="h2title">注册
        </h2>

        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <form class="form-horizontal heiti" id="login">
                    <div class="form-group">
                        <div class="">
                            <input type="password" class="form-control" id="inputPassword3"
                                   placeholder="邮箱">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <input type="password" class="form-control" id="inputPassword3"
                                   placeholder="昵称">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <input type="password" class="form-control" id="inputPassword3"
                                   placeholder="密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <input type="password" class="form-control" id="inputPassword3"
                                   placeholder="确认密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class=" text-center">
                            <button type="submit" class="btn btn-warning btn-block" id="login-btn">提交注册
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('bottom')
    <script>
        // 三个状态：游客、访客、居民　设置一个 cookie变量进行初始化页面
        // 成功输入邀请码后，first page 左侧: 显示 #yilu-portal-tabs 并切换到第二个tab content
    </script>
@stop
