@extends('layouts.columns._'.$columnInfo['id'])



@section('content')
    <div class="container">
        <div class="row" id="column-box">


            <div class="col-sm-5 col-sm-push-7">
                <div id="side">
                    <div id="LMap-box">
                        <div id="side-first-page">
                            <div id="LMap">
                                <div class="map"></div>
                            </div>
                        </div>
                        <div id="LMap-info-swipebox">
                            <section id="LMap-info">
                                <p id="LMap-info-addr" v-html="addr"></p>
                                <div id="LMap-info-intro" v-html="intro"></div>
                            </section>
                        </div>
                        <?php
                        $mapInfosByID = []; $IDs = [];
                        ?>
                        @foreach($vols as $vol)
                            @foreach($vol->firstArticlesSimple as $article)
                                @if($article->places->count()>0)
                                    <?php $a_place = $article->places[0];$IDs[] = $article->id;  ?>
                                    <?php
                                    $mapInfosByID[$article->id] = [
                                        'addr' => $a_place->pivot->place_name ?? $a_place->name ?? $a_place->name_en,
                                        'intro' => $a_place->pivot->intro]
                                    ?>

                                @endif
                            @endforeach
                        @endforeach

                    </div>
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
                                                <a href="{!! $vol->column->url !!}/{!!  $article->slug !!}">{!! $article->title !!}</a>
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
                                                        href="{!! $vol->column->url !!}/{!!  $article->slug !!}">{!! $article->title !!}</a>
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
        @if($quotes)
            <div id="quotes-slide">
                {{--@foreach($quotes as $quote)--}}
                {{--<article>--}}
                {{--<blockquote class="bottom-quote">--}}
                {{--<header><span class="bottom-quote-no">{!! $quote->no !!}</span>--}}
                {{--<h1 class="bottom-quote-title" id="{!! $quote->no !!}"><a--}}
                {{--href="{!! '/q/'.$quote->slug !!}">{!! $quote->title !!}</a>--}}
                {{--</h1>--}}
                {{--</header>--}}
                {{--<div class="bottom-quote-body">{!! $quote->body !!}</div>--}}
                {{--<cite class="cite-tail-right"><a--}}
                {{--href="{!! $quote->origin_url !!}">{!! $quote->author !!}</a></cite>--}}
                {{--</blockquote>--}}
                {{--</article>--}}
                {{--@endforeach--}}
            </div>
            <script>
                var quoteSlick = $('#quotes-slide').slick({
                    autoplay: true,
                    autoplaySpeed: 9000,
                    dots: true,
//                variableWidth: true, // 自定义每个幻灯片的宽度 .slick-slide{ width: ...px; }
//                    slidesToShow: 2,
//                    slidesToScroll: 2,
                    arrows: false,
                    mobileFirst: false,
                })
            </script>
        @endif
    </div>
@endsection

@section('script_b')
    <script>
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

        zc.list.init({
            itemIDs:{!! json_encode($IDs) !!},
            plots: plots,

            listArea: '#L', // 列表

            affix: '#LMap-box',

            info: {
                ele: '#LMap-info',
                data:{!! json_encode($mapInfosByID) !!},
                swipeBox: '#LMap-info-swipebox', // for swipe, 如果直接在 #LMap-info上面swipe,会被Vue破坏
            },

            findItemToUp: function (id) {  // 自动把目标元素滚动上来 这里是寻找目标元素的方法 找到.vol就行 不细化到 article
                var item = $(document.getElementById(id)).parents('.vol');
                if (item.parent()[0] == $('#L')[0]) {
                    zclog('[scroll] found vol for id ', id)
                    return item;
                }
            },

            spy: {
                target: '.L-item-title', // if one of the targets is in viewport
                getId: function (targetElement) {
                    // return  a real integer or NaN
                    return parseInt(targetElement && targetElement.getAttribute('id'));
                },
                targetScope: 'article', // mouse over this scope, then use the related target in the scope
            },
        })

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


    </script>
@endsection
