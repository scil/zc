@extends('layouts.base',['title' => MENU_ITEMS[$LOCALE]["hall"]['title'], 'desc' => MENU_ITEMS[$LOCALE]["hall"]['desc']])


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class=" text-center first-page first-page-middle zc-slides" id="home-first-page">

                    <div>
                        <div class="quote-img">
                            <img id="thankyou" src="/img/org/throw.png">
                            <script>
                                // var thankyou_img=['/img/org/throw.png',
                                //     '/img/org/flower.jpg'
                                // ], index=0;
                                // setInterval(function () {
                                //     document.getElementById('thankyou').src= thankyou_img[index];
                                //     index = 1 -index;
                                // },3500)
                            </script>
                        </div>

                        <div class="quote-text">
                            <div>
                                <p>欢迎反馈</p>
                            </div>
                        </div>
                        <a class="pure-kaiti quote-src btn btn-warning btn-primary-outline btn-sm">真城</a>
                    </div>

                    <div>
                        <div class="quote-img">
                            <img src="/img/org/washington.jpg">
                        </div>

                        <div class="quote-text">
                            <div>
                                <p>The Constitution is the guide which I never will abandon.</p>
                            </div>
                        </div>
                        <a class="pure-kaiti quote-src btn btn-warning btn-primary-outline btn-sm">George
                            Washington</a>
                    </div>

                    <div>

                        <div class="quote-img" style="border-width:0;width: 100px;height: 150px;border-radius: 20%;;">
                            <img src="/img/org/americansdon27ttrust.jpg"
                            >
                        </div>
                        {{--美国宪法为何读起来这么“别扭”--}}
                        {{--去除文字后，需加大图片和按钮的距离--}}
                        <div class="quote-text" style="margin-top: 5%;">
                        </div>
                        <a href="//weibo.com/p/1001603916291386828065" target="_blank"
                           class="pure-kaiti quote-src btn btn-warning btn-primary-outline btn-sm">美国 Constitution
                            为何读起来这么“别扭”</a>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <div class="container townhall-one">
        <h2 class="h2title text-center heiti">财务栏
        </h2>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <table class="table table-bordered">
                    <colgroup>
                        <col width="">
                        <col width="20%">
                        <col width="25%">
                        <col width="20%">
                        <col width="">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>日期</th>
                        <th>内容</th>
                        <th>金额(CNY)</th>
                        <th>备注</th>
                    </tr>
                    </thead>
                    @include('partials.country._finance')
                </table>
            </div>
        </div>
        <hr>
    </div>




    {{--<div class="container townhall-one ">--}}
    {{--<h2 class="h2title text-center heiti">城务员</h2>--}}

    {{--<div class="row text-center">--}}
    {{--<div class="col-sm-6 col-sm-offset-3" id="zc-workers">--}}

    {{--<table class="table table-bordered  table-hover">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<th>名字</th>--}}
    {{--<th>职务</th>--}}
    {{--<th>QQ</th>--}}
    {{--<th>微信</th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--<tr>--}}
    {{--<td>结巢人境</td>--}}
    {{--<td>站长</td>--}}
    {{--<td></td>--}}
    {{--<td></td>--}}
    {{--</tr>--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}


    <div class="modal fade" tabindex="-1" role="dialog" id="global-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="global-modal-title">

                    </h4>
                </div>
                <div class="modal-body" id="global-modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@stop

@section('bottom')
    <script>
        $('#home-first-page').slick({
            initialSlide: 0,
            autoplay: false,
            autoplaySpeed: 25000,
            arrows: false,
            mobileFirst: true,
        });

        $('body').on('click', '.baihui-share', function () {
            var title = $(this).attr('title')
            var body =
                '<iframe width="100%" height="400" style="border:1px solid #ccc;margin-bottom: 10px;" frameborder="0" scrolling="no" src="'
                + $(this).attr('href')
                + '"> </iframe>'
                + '<p>注：本表原始文档存放在<a target="_blank" href="'
                + $(this).attr('g-url')
                + '">google drive</a></p>'

            $('#global-modal-title').text(title);
            $('#global-modal-body').html(body);
            $('#global-modal').modal();
            return false;
        })

    </script>
@stop
