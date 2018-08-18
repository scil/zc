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
                    @foreach($quotes as $quote)
                        @if($quote->places->count()>0)
                            <?php $a_place = $quote->places[0];$IDs[] = $quote->id;  ?>
                            <?php
                            $mapInfosByItemID[$quote->id] = [
                                'addr' => $a_place->pivot->place_name ?? $a_place->name ?? $a_place->english_name,
                                'title' => $a_place->pivot->title,
                                'intro' => $a_place->pivot->intro
                            ];
                            ?>

                        @endif
                    @endforeach
                </div>
            </div>


            <div class="col-sm-7 col-sm-pull-5">
                <div id="QL">
                    @foreach($quotes as $quote)
                        <article class="QL-item">
                            <header class="L-item-header clearfix">
                                @if($columnLevel==2)
                                    <span class="prefix-col-name prefix-col-name-{!! $quote->quoteable->css !!}">{!! $quote->quoteable->short_name !!}</span>
                                @else
                                    <span class="prefix-col-name prefix-col-name-{!! $columnCss !!}">{!! $quote->order !!}</span>
                                @endif
                                <h1 class="L-item-title" id="{!! $quote->id !!}"><a
                                            href="/{!! $url !!}/{!! $quote->slug !!}">
                                        {!! $quote->title !!}{!! $quote->sub_title?' —— '. $quote->sub_title :'' !!}</a>
                                </h1>
                            </header>
                            <div class="QL-item-body">{!! $quote->intro !!}</div>
                            @if($quote->image)
                                <img src="{!! $quote->image->url?:$quote->image->local !!}"
                                     alt="{!! $quote->image->alt !!}"
                                     class="QL-item-img"
                                        {!! $quote->image->style ? 'style="'.$quote->image->style.'"':'' !!}>
                                @if($quote->image->intro)
                                    <p class="kaiti">
                                        {!! $quote->image->intro !!}
                                    </p>
                                @endif
                            @endif
                            <div class="QL-read-more-box">
                                @if($quote->b_long)
                                    <a class="QL-read-more btn btn-default"
                                       href="/{!! $url !!}/{!! $quote->slug !!}"></a>
                                @endif
                                <div class="QL-item-info-box">
                                    @if($quote->origin_url)
                                        <a href="{!! $quote->origin_url !!}" target="_blank">
                                            <span class="truncate QL-item-info">By：{!! ($quote->author?$quote->author .' . ':''). $quote->origin !!}</span>
                                        </a>
                                    @else
                                        <span class="truncate QL-item-info">By：{!! ($quote->author?$quote->author .' . ':''). $quote->origin !!}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                        <hr class="QL-item-hr">
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
@endsection

@section('bottom')
    <script>

        function standalone_func() {
            $('cite', '#QL').addClass('cite-tail');
        }
        standalone_func();

        function dependent_func() {


            var plots = {
            @foreach($quotes as $quote)
            @if($quote->places->count()>0)
            <?php $place = $quote->places[0];?>
            {!! $quote->id !!}:
            {
                latitude: '{!! $place->lat !!}', longitude
            :
                '{!! $place->lng !!}',
            }
        ,
            @endif
            @endforeach
        }
            ;

            @if($IDs)
            zc.sideMap.init({
                itemIDs:{!! json_encode($IDs) !!},
                plots: plots,

                side: {
                    ele: $('#side'),
                    affixEle: $('#LMap-box'),
                    swipeBoxEle: $('#LMap-info-swipebox'), // for swipe, 如果直接在 #LMap-info上面swipe,会被Vue破坏
                    infoElements: {
                        'addr': $('#LMap-addr'),
                        'title': $('#LMap-info-title'),
                        'intro': $('#LMap-info-intro')
                    },
                    infoEle: '#LMap-info',
                    infoData:{!! json_encode($mapInfosByItemID) !!},
                    infoKeys: ['title', 'intro'],
                },

                contentArea: '#QL',
                findItemByPlotID: function (id) {
                    var h1 = $(document.getElementById(id)).parents('article');
                    return h1;
                },
                getPrevious: function (id) {
                    return prevVol = $('#' + id).parents('article').prevUntil('article').prev();
                },
                lightID: null,
                spy: {
                    field: '#QL',
                    target: '.L-item-title',
                    getId: null,
                    targetItemScope: '.QL-item',
                },

            })

            @endif
        }

        //# sourceURL=qList
    </script>

@endsection
