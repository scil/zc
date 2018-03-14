@extends('layouts.columns._'.$column_id)

@section('content')
    <div class="container">
        <div class="row" id="column-box">


            <div class="col-sm-5">
                <div id="side">
                <div id="LMap-box">
                    <div id="side-first-page">
                        <div id="LMap">
                            <div class="map"></div>
                        </div>
                    </div>
                    <div id="LMap-info-swipebox">
                    <section id="LMap-info">
                        <p id="LMap-info-title" v-html="title"></p>
                        <div id="LMap-info-intro" v-html="intro"></div>
                    </section>
                    </div>
                    <?php
                    $mapInfosByID = []; $IDs=[];
                    ?>
                    @foreach($medias as $media)
                        @if($media->places->count()>0)
                            <?php $a_place = $media->places[0];$IDs[]= $media->id;  ?>
                            <?php
                            $mapInfosByID[$media->id] = [
                                'title' => $a_place->pivot->title,
                                'intro' => $a_place->pivot->intro];
                            ?>

                        @endif
                    @endforeach

                </div>
            </div>
        </div>


            <div class="col-sm-7">
                <div id="QL">
                @foreach($medias as $media)
                    <article class="QL-item Big-Href">
                        <header class="L-item-header clearfix">
                                <span class="prefix-col-name prefix-col-name-1">{!! $media->volume->no !!}</span>
                            <h1 class="L-item-title" id="{!! $media->id !!}"><a
                                        href="/{!! $media_type !!}/{!! $media->slug !!}">{!! $media->name !!}</a></h1>
                        </header>
                        <div class="QL-item-body">{!! $media->intro !!}</div>
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

@section('script_b')
    <script>

        var plots = {
        @foreach($medias as $media)
        @if($media->places->count()>0)
        <?php $all_plots_ids[] = $media->order; $place = $media->places[0];?>
        {!! $media->id !!}:
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

        @if(isset($all_plots_ids))
        zc.list.init({
            all_plots: [<?php echo implode(',', $all_plots_ids)  ?>],
            plots: plots,
            IDs:{!! json_encode($IDs) !!},

            listArea: '#QL',
            findItemWay: function (id) {
                var h1 = $(document.getElementById(id)).parents('article');
                return h1;
            },
            infoSwipeBox: '#LMap-info-swipebox', // for swipe, 如果直接在 #LMap-info上面swipe,会被Vue破坏

            infoEle: '#LMap-info',
            infoData:{!! json_encode($mapInfosByID) !!},

            spyItem: '.QL-item',
            spyTarget: '.L-item-title',
            spyTargetAttrWithPlotID: 'id',

            affix: '#LMap-box',
            whoes_width_to_change: '#LMap-info',
            affix_children_width_to: '#LMap',
        })

        @endif

        zc.content._bigHref();

    </script>

@endsection
