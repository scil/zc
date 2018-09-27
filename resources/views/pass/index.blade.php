{{--@ extends('layout._base')--}}
@extends('layouts.base',['title' => MENU_ITEMS[$LOCALE]["pass"]['title'], 'desc' => MENU_ITEMS[$LOCALE]["pass"]['desc']])

@section('content')
    <div class="container make-footer-margin-top-smaller">
        <div class="row">
            <div class="col-sm-12">
                <div class="first-page" id="yilu-first-page">

                    <div class="row">
                        <div class="col-sm-5 col-xs-12 col-sm-push-7 first-page-middle" id="yilu-login">
                            <form class="form-horizontal heiti" id="login">
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-9">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="昵称、邮箱"  disabled >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-9">
                                        <input type="password" class="form-control" id="inputPassword3" disabled
                                               placeholder="密码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-9">
                                        <div class="checkbox">
                                            <label class="oneline-label">
                                                <input type="checkbox" class="checkbox-with-text"> 下次自动登陆
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-9 text-center">
                                        <button type="submit" class="btn btn-warning btn-block" id="login-btn">非常抱歉，暂时封山
                                        </button>
                                        <div>
                                            <a class="btn btn-default pull-right btn-xs login-btn" href="#"
                                               role="button">使用邀请码</a>
                                            <a class="btn btn-default pull-right btn-xs login-btn" href="#"
                                               role="button">找回密码</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-7 col-xs-12 col-sm-pull-5">
                            <div id="yilu-login-intro" class="yilu-firstpage-text">
                                    {{--<p>认清真相；热爱生活。</p>--}}
                                    {{--<footer>—— Romain Rolland</footer>--}}
                                目标的实现，需要一步步的工作，还有或这或那的牺牲。
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('bottom')
    <script>
    </script>
@endsection
