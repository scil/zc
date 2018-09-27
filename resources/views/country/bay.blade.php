@extends('layouts.base',['title' => MENU_ITEMS[$LOCALE]["bay"]['title'], 'desc' => MENU_ITEMS[$LOCALE]["bay"]['desc']])


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
                                <p id="TREE-Q">淡水湾</p>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>


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
