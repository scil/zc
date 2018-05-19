@extends('layouts.columns._'.$column_id,['title'=>$title,'desc'=>$quote->desc])

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
                        @if($quote->places->count()>0)
                            {{-- only get the first place  --}}
                            <?php $a_place = $quote->places[0];$IDs[] = $quote->id;  ?>
                            <?php
                            $mapInfosByID[$quote->id] = [
                                'addr' => $a_place->pivot->place_name ?? $a_place->name ?? $a_place->name_en,
                                'intro' => $a_place->pivot->intro];
                            ?>

                        @endif

                    </div>
                </div>
            </div>


            <div class="col-sm-7 col-sm-pull-5">
                <article>
                    @if($quote->title)
                        <header>
                            <h1 id="item-title">{!!  $quote->title !!}</h1>
                        </header>
                        <div class="item-info" {!! $quote->origin_url?'data-url="'.$quote->origin_url.'"':'' !!} >
                            <span>文：{!! $quote->author?:$quote->origin !!}</span>
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
                            {!! $quote->body_long ?? $quote->body !!}
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


@section('script_b')
    <script>

        zc.content.init();

        var plots = {

        @if($quote->places->count()>0)
        {{-- only get the first place  --}}
        <?php $place = $quote->places[0];?>
        {!! $quote->id !!}:
        {
            latitude: '{!! $place->lat !!}', longitude
        :
            '{!! $place->lng !!}',
        }
        ,
        @endif

        }
        ;

        @if(!empty($IDs))
        zc.sideMap.init({
            itemIDs:{!! json_encode($IDs) !!},
            plots: plots,

            side: {
                ele: $('#side'),
                //affixEle: $('#LMap-box'),
                //swipeBoxEle: $('#LMap-info-swipebox'), // for swipe, 如果直接在 #LMap-info上面swipe,会被Vue破坏
                infoEle: '#LMap-info',
                infoData:{!! json_encode($mapInfosByID) !!},
            },

            contentArea: '#QL',
            findItemByPlotID: function (id) {
                return null;
            },
            spy: {
                field: '#QL',
                target: '.L-item-title',
                getId: null,
                targetItemScope: '.QL-item',
            },

        })

        @endif

        //# sourceURL=qList
    </script>
@stop
