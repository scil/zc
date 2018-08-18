@extends('layouts.base')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class=" text-center first-page first-page-middle zc-slides" id="home-first-page"
                     style="background-color: #ffa500b0;">

                    <div>
                        <div class="quote-img">
                            <img src="/img/org/tree.jpg">
                        </div>

                        <div class="quote-text" style="margin-top: 4.5%; margin-bottom: 0%;">
                            <div>
                                <p id="TREE-Q">三角湾</p>
                            </div>
                        </div>
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
    <script></script>
@stop
