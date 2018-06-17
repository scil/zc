@extends('layouts.base'.$pjax)

@section('content')
    <div class="container">
        <div class="row" id="column-box">


            <div class="col-sm-5 col-sm-push-7">

                <div id="side">
                    @include('partials.LMap')

                    <?php
                    $mapInfosByItemID = []; $IDs = [];
                    ?>
                    @foreach($vols as $vol)
                        @foreach($vol->firstArticlesSimple as $article)
                            @if($article->places->count()>0)
                                {{-- only get the first place  --}}
                                <?php $a_place = $article->places[0];$IDs[] = $article->id;  ?>
                                <?php
                                $mapInfosByItemID[$article->id] = [
                                    'addr' => $a_place->pivot->place_name ?? $a_place->name ?? $a_place->name_en,
                                    'title' => $a_place->pivot->title,
                                    'intro' => $a_place->pivot->intro]
                                ?>

                            @endif
                        @endforeach
                    @endforeach

                </div>
            </div>


            <div class="col-sm-7 col-sm-pull-5">
                <div id="L">
                    @foreach($vols as $vol)
                        @if($columnLevel==2)
                            <div class="vol">
                                @foreach($vol->firstArticlesSimple as $article)
                                    <article>
                                        <header class="L-item-header clearfix">
                                            <span class="prefix-col-name prefix-col-name-{!! $vol->column->css !!}">{!! $vol->column->short_name !!}</span>
                                            <h1 class="L-item-title" id="{!! $article->id !!}">
                                                <a href="{!! $vol->column->url !!}/{!!  $article->slug !!}">
                                                    {!! $article->title !!}{!! $article->sub_title?' —— '. $article->sub_title :'' !!}</a>
                                            </h1>
                                        </header>
                                        <p>{!! $article->intro !!}</p>
                                    </article>
                                    @break
                                @endforeach
                                <hr class="L-item-hr">
                            </div>
                        @else
                            <div class="vol {!! $vol->firstArticlesSimple->count()>1? 'limit-height' :'' !!}">
                                @foreach($vol->firstArticlesSimple as $article)
                                    <article>
                                        <header class="L-item-header clearfix">
                                            @if ($loop->first)
                                                <span class="prefix-col-name  prefix-col-name-{!! $columnInfo['css'] !!}">{!! $vol->no !!}</span>
                                                <span class="no-in-vol no-in-vol-1">{!! $loop->index + 1 !!}</span>
                                            @else
                                                <span class="no-in-vol">{!! $loop->index + 1 !!}</span>
                                            @endif
                                            <h1 class="L-item-title" id="{!! $article->id !!}"><a
                                                        href="{!! $vol->column->url !!}/{!!  $article->slug !!}">
                                                    {!! $article->title !!}{!! $article->sub_title?' —— '. $article->sub_title :'' !!}</a>
                                            </h1>
                                        </header>
                                        <p>{!! $article->intro !!}</p>
                                        @if($loop->first)
                                            <hr class="vol-item-hr vol-item-hr-1">
                                        @elseif(! $loop->last)
                                            <hr class="vol-item-hr">
                                        @endif
                                    </article>
                                @endforeach
                                <hr class="L-item-hr">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>


        </div>
    </div>
@endsection

@section('bottom')
    <script>
        function dependent_func() {

            var plots = {
            @foreach($vols as $vol)
            @foreach($vol->firstArticlesSimple as $article)
            @if($article->places->count()>0)

            <?php  $a_place = $article->places[0]; ?>
            {!! $article->id !!}:
            {
                latitude: '{!! $a_place->lat !!}', longitude
            :
                '{!! $a_place->lng !!}',
            }
        ,
            @endif
            @endforeach
            @endforeach
        }
            ;

            @if($IDs)

            zc.sideMap.init({
                itemIDs:{!! json_encode($IDs) !!},
                plots: plots,

                side: {
                    ele: $('#side'),
                    affixEle: $('#LMap-box'), // also used by scrollspy as a viewRef
                    swipeBoxEle: $('#LMap-info-swipebox'), // for swipe, 如果直接在 #LMap-info上面swipe,会被Vue破坏
                    infoEle: '#LMap-info',
                    infoElements: {
                        'addr': $('#LMap-addr'),
                        'title': $('#LMap-info-title'),
                        'intro': $('#LMap-info-intro')
                    },
                    infoData:{!! json_encode($mapInfosByItemID) !!},
                },

                contentArea: '#L', // 列表
                findItemByPlotID: function (id) {  // 操作map, 自动把目标元素滚动上来 这里是寻找目标元素的方法 目前找到.vol就行 不细化到 article
                    var item = $(document.getElementById(id)).parents('.vol');
                    if (item.parent()[0] === $('#L')[0]) {
                        //zclog('[up] found vol for id ', id)
                        return item;
                    }
                },
                getPrevious: function (id) {
                    return prevVol = $('#' + id).parents('.vol').prev();
                },
                lightID: null,
                spy: {
                    field: '#L',
                    target: '.L-item-title', // if one of the targets is in viewport
                    getId: null,
                    targetItemScope: 'article', // mouse over this scope, then use the related target in the scope
                },
            });

            @endif



            zc.content.limitHeight({
                containers: $('.limit-height'),
                scrollBack: true,
                readMore: function (container, button) {
                    container.addClass('no-limit-height');
                    button.addClass('read-less');
                },
                readLess: function (container, button) {
                    container.removeClass('no-limit-height');
                    button.removeClass('read-less');
                },
                fix: false,
//            containerDefaultHeight:350,  // 容器缩小时的高度　optional, used for update fix status
            })

        }
        //# sourceURL=articleList
    </script>
@endsection
