@extends('layouts.columns._'.$columnId)

@section('content')

    <script defer async
            src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDQTw3XpAfgObEKhsELH_Tcicj8SpJqnDE&callback=loadMap">
    </script>

    <script>
        function loadMap() {
//            jQuery.getScript("/js/gmaps.js", initMap);
            jQuery.getScript("//cdn.bootcss.com/gmaps.js/0.4.22/gmaps.min.js", initMap);
        }
        var zmap;
        function initMap() {
            var map = new GMaps({
                div: '#map',
                lat: 40.497,
                lng: 143.277,
                zoom: 1,
            });
            zmap = (new ZMap(map)).addNewPlaceBtn();


        }

        function ZMap(map) {
            this.map = map;
            this._addBtn = null;
        }
        ZMap._markersNum = 0;
        ZMap.prototype = {
            prepareNewMarker: function () {
                return ++ZMap._markersNum;
            },
            addNewPlaceBtn: function () {
                if (this._addBtn) {
                    return this;
                }
                var me = this;
                this._addBtn = me.map.addControl({
                    position: 'top_right',
                    content: '+',
                    style: {
                        margin: '5px',
                        padding: '1px 6px',
                        border: 'solid 1px #717B87',
                        fontSize: '18px',
                        lineHeight: '18px',
                    },
                    events: {
                        click: function () {
                            me.onPlaceAdd();
                        }
                    }
                });
                return this;
            },
            onPlaceAdd: function () {

                var centre = this.map.getCenter();
                var lat = centre.lat(), lng = centre.lng();
                var markerIndex = this.prepareNewMarker();
                var infoID = 'zmap-info-' + markerIndex;
                var marker = this.map.addMarker({
                    lat: lat,
                    lng: lng,
                    title: 'New place',
                    draggable: true,
                    details: {
                        infoID: infoID,
                        model: null,
                    },
                    infoWindow: {
                        content: '<div id="' + infoID + '" class="">' +
                        '<input type="hidden" class="zmap-lat" v-model="lat" />' +
                        '<input type="hidden" class="zmap-lng" v-model="lng" />' +
                        '<input class="zmap-intro" v-model="intro" />' +

                        '</div>',
                        domready: function () {
                            var marker = this.getAnchor();
                            if (marker.details.model) {
                                return;
                            }

                            var v = new Vue({
                                el: '#' + marker.details.infoID,
                                data: {
                                    lat: marker.lat,
                                    lng: marker.lng,
                                    intro: 's',
                                }
                            })
                            marker.details.model = v;
                        }
                    }
                });
                ;


                gm.event.addListener(newMarker, "dragend", function (evt) {
                    var currMarker = this;
                    // only time when lat/lng can change!
                    currMarker.details.lat = evt.latLng.lat();
                    currMarker.details.lng = evt.latLng.lng();
                    var tip = $(currMarker.tooltip.content);
                    tip.find(".mapsed-lat").val(currMarker.details.lat);
                    tip.find(".mapsed-lng").val(currMarker.details.lng);
                });
                // for tooltip to be displayed
                gm.event.trigger(newMarker, "click");


            },
        }
    </script>

    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <form class="form" method="POST"
                      action="{!! isset($article)? '/article/'.$article->id :'/new_article' !!}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @if(isset($article))
                        <input type="hidden" name="_method" value="PUT">
                    @endif
                    <input type="hidden" name="user_id" value="1">

                    @include('partials.columns._select_opt_shanshui',['label'=>'发表文章'])

                    <h1 class="title">
                        <input name="title"
                               class="simple-input"
                               {!! isset($article)?'value="'.$article->title.'"':''!!} placeholder="文章标题">
                    </h1>

                    <hr>
                    <div class="one-line-input clearfix">
                        <input name="slug" class="simple-input autosize"
                               {!! isset($article)?'value="'.$article->slug.'"':''   !!} placeholder="slug">
                        <input name="no" class="simple-input"
                               {!! isset($article)?'value="'.$article->no.'"':'' !!} placeholder="no.">
                    </div>

                    <div class="one-line-input clearfix">
                        <input name="origin" class="simple-input autosize"
                               {!! isset($article)?'value="'.$article->origin.'"':'' !!} placeholder="来源">
                        <input name="origin_date" class="simple-input form-date"
                               {!! isset($article)?'value="'.$article->origin_date.'"':'' !!} placeholder="2000/01/01">
                        <label class="oneline-label simple-label">
                            <input name="show_date"
                                   type="checkbox" {!! isset($article)&&$article->show_date ?'checked' :'' !!}>
                            显示时间字段
                        </label>
                    </div>
                    <div class="one-line-input clearfix">
                        <input name="origin_url" type="text" class="simple-input autosize"
                               {!! isset($article)?'value="'.$article->origin_url.'"':'' !!} placeholder="来源网址">
                        <label class="oneline-label simple-label">
                            <input name="link" type="checkbox" {!! isset($article)&&$article->link ?'checked' :'' !!}>
                            链接
                        </label>
                    </div>
                    <textarea name="origin_tip" class="simple-input" rows="1"
                              placeholder="来源备注">{!! isset($article)?$article->origin_tip:''  !!}</textarea>

                    <textarea name="intro" class="simple-input" rows="3"
                              placeholder="导言">{!! isset($article)?$article->intro:''  !!}</textarea>

                    <div id="body-box">
                        <textarea name="body" class="simple-input monitor-change" rows="3" id="body"
                                  placeholder="正文">{{ isset($article)?($article->md ?: $article->body):''  }}</textarea>
                    </div>

                    <textarea name="copyright" class="simple-input monitor-change" rows="2"
                              placeholder="版权信息">{!! isset($article)? $article->copyright:''  !!}</textarea>


                    <textarea name="quotes" class="simple-input markdown-input monitor-change" rows="2"
                              placeholder="摘录">{!! isset($article)? $article->quotes:''  !!}</textarea>

                    <textarea name="links" class="simple-input markdown-input monitor-change" rows="2"
                              placeholder="相关文章">{!! isset($article)? $article->links:''  !!}</textarea>


                    <div id="settings">
                        <a class="section-title" role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#settings-body" aria-expanded="true" aria-controls="collapseOne">
                            设置
                        </a>
                        <div class="collapse" id="settings-body">
                            <div class="radios">
                                {{--<label for="inputPassword3" class="col-sm-2 control-label">状态</label>--}}

                                <label class="radio-inline">
                                    <input name="status" type="radio" id="inlineRadio1" value="0"
                                            {!! isset($article)&&$article->status==0 ?'checked' :'' !!}
                                    > 蓄势待发</input>
                                </label>
                                <label class="radio-inline">
                                    <input name="status" type="radio" value="2"
                                            {!! isset($article)&&$article->status==2 ?'checked' :'' !!}
                                    > 退居二线</input>
                                </label>
                                <label class="radio-inline">
                                    <input name="status" type="radio" id="inlineRadio2" value="1"
                                            {!! isset($article)&&($article->status!=1) ?'' :' checked' !!}
                                    > 登台亮相</input>
                                </label>
                            </div>
                            <div class="radios">
                                {{--<label for="inputPassword3" class="col-sm-2 control-label">深度</label>--}}

                                <label class="radio-inline">
                                    <input name="deep" type="radio" id="inlineRadio1" value="open"
                                            {!! isset($article)&&($article->status!=0) ?'' :' checked' !!}
                                    > 广而告之
                                </label>
                                <label class="radio-inline">
                                    <input name="deep" type="radio" id="inlineRadio2" value="member"
                                            {!! isset($article)&&$article->status==1 ?'checked' :'' !!}
                                    > 开门见山
                                </label>
                                <label class="radio-inline">
                                    <input name="deep" type="radio" id="inlineRadio3" value="deep"
                                            {!! isset($article)&&$article->status==2 ?'checked' :'' !!}
                                    > 红头文件
                                </label>
                            </div>
                        </div>
                    </div>


                    <div>
                        <a class="section-title" role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#comment-body" aria-expanded="true" aria-controls="collapseOne">
                            备注
                        </a>
                        <div class="collaps in" id="comment-body">
                            <textarea name="comment" id="comment" class="simple-input" rows="3" placeholder="备注">
                                 {!! isset($article)?$article->comment :'' !!}
                            </textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-default">提交</button>
                    @if(isset($article))
                        <button class="btn btn-default btn-del">删除</button>
                    @endif
                </form>


            </div>
            <div class="col-sm-5">

                <div id="map"></div>

            </div>
        </div>

    </div>
@stop


@section('script_b')
    <script>
        @if(isset($article))
        column_id = {!! $article->column_id !!}
        @endif

        VMasker(document.getElementsByClassName("form-date")).maskPattern('9999/99/99');
        //        $('.autosize').autoGrowInput({minWidth: 70, maxWidth: 300, comfortZone: 15});

        var editor = zc.editor.init('body');

        zc.form.init();


    </script>
@stop
