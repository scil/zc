@extends('layouts.base'.$pjax,['desc'=>$quote->desc])

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div id="item-no">NO. {!! $quote->order !!}</div>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-5 col-sm-push-7">
                <div id="side">
                    @include('partials.LMap')
                    <?php
                    $mapInfosByPlaceID = []; $IDs = [];
                    ?>
                    @foreach($quote->places as $place)
                        {{-- only get the first place  --}}
                        <?php $IDs[] = $place->id ;  ?>
                        <?php
                        $mapInfosByPlaceID[$place->id] = [
                            'addr' => $place->pivot->place_name ?? $place->name ?? $place->english_name,
                            'title' => $place->pivot->title,
                            'intro' => $place->pivot->intro];
                        ?>

                    @endforeach

                </div>
            </div>


            <div class="col-sm-7 col-sm-pull-5">
                <article>
                    @if($quote->title)
                        <header>
                            @if($quote->sub_title)
                                <h1 id="item-title">{!!  $quote->title !!}<small> —— {!! $quote->sub_title !!}</small></h1>
                            @else
                                <h1 id="item-title">{!!  $quote->title !!}</h1>
                            @endif
                        </header>
                        <div class="item-info">
                            @if($quote->origin_url)
                                <span>文：<a href="{!! $quote->origin_url !!}" target="_blank">
                                            {!! ($quote->author?$quote->author .' . ':''). $quote->origin !!}</a>
                                    </span>
                            @else
                                <span>文：{!! ($quote->author?$quote->author .' . ':''). $quote->origin !!}</span>
                            @endif
                            @if($quote->show_date)
                                <time pubdate
                                      datetime="{!! $quote->origin_date !!}">{!! $quote->origin_date !!}</time>
                            @endif
                        </div>
                    @endif

                    @if($quote->body_long)

                        <div id="body">
                            {!! $quote->body_long !!}
                        </div>
                    @else
                        <blockquote id="QItem" class="z-free">
                            {!! $quote->body_long ?? $quote->intro !!}
                            @unless($quote->title)
                                <cite class="cite-tail-right quote-item-cite"><a target="_blank"
                                                                                 href="{!! $quote->origin_url !!}">{!! $quote->author !!}</a></cite>
                            @endunless
                            <span data-c="{!! $quote->codes !!}"></span>
                        </blockquote>
                        <hr id="QItem-hr">
                        @if($quote->image)
                            <img src="{!! $quote->image->url?:$quote->image->local !!}"
                                 alt="{!! $quote->image->alt !!}"
                                 id="QItem-img"
                                    {!! $quote->image->style ? 'style="'.$quote->image->style.'"':'' !!}>
                            @if($quote->image->intro)
                                <p class="kaiti">
                                    {!! $quote->image->intro !!}
                                </p>
                            @endif
                        @endif

                </article>
            </div>

            <main class="row middle-for-item-quote">


            </main>
            <style>
                .footnotes-list {
                    list-style-type: circle;
                    padding-left: 1.5em;
                    margin-top: 100px;
                    font-size: 13px;
                }

                .footnote-backref {
                    display: none;
                }
            </style>
            <script>
                $('#quote-item-first-page>.footnotes').insertAfter($('#quote-item-first-page')).show()
            </script>
            @endif


        </div>
    </div>
@stop


@section('bottom')
    <script>

        function standalone_func() {
            $('cite', '#QItem').addClass('cite-tail');
        }
        standalone_func();

        function dependent_func() {
            zc.content.init();


            var plots = {

            @foreach($quote->places as $place)
            {{-- only get the first place  --}}
            {!! $place->id !!}:
            {
                latitude: '{!! $place->lat !!}', longitude
            :
                '{!! $place->lng !!}',
            }
        ,
            @endforeach

        }
            ;

            @if($IDs)
            zc.sideMap.init({
                itemIDs:{!! json_encode($IDs) !!},
                plots: plots,

                side: {
                    ele: $('#side'),
                    widthEle: $('#LMap-box'),
                    //affixEle: $('#LMap-box'),
                    //swipeBoxEle: $('#LMap-info-swipebox'), // for swipe, 如果直接在 #LMap-info上面swipe,会被Vue破坏
                    infoElements: {
                        'addr': $('#LMap-addr'),
                        'title': $('#LMap-info-title'),
                        'intro': $('#LMap-info-intro')
                    },
                    infoEle: '#LMap-info',
                    infoData:{!! json_encode($mapInfosByPlaceID) !!},
                },

                contentArea: '#QL',
                findItemByPlotID: function (id) {
                    return null;
                },
                lightID:{!! $IDs[0] !!},
                spy: {
                    field: '#QL',
                    target: '.L-item-title',
                    getId: null,
                    targetItemScope: '.QL-item',
                },

            })

            @endif
        }
        //# sourceURL=quote
    </script>
@stop
