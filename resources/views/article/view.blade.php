@extends('layouts.columns._'.$column_id,['title'=> $title ,'desc'=>$article->desc])

@section('content_top')
    @if($article_type=='book'||$article_type=='video')
        <div id="item-no"><a href="/{!! $article_type !!}/{!! $media->slug !!}">{!! "{$media->name}"   !!}</a></div>
    @elseif($article_type=='vol')
        @if($article->volume->articles->count()>0)
            <div id="item-no" class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuV" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">第 {!! $article->volume->no !!} 卷<span
                            class="caret" id="dropDownCaret"></span>
                </button>
                <ul class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuV">
                    @foreach($article->volume->articles as $a_article)
                        <li{!! $article->id ==$a_article->id?' class="disabled"' :'' !!}>
                            <a href="{!! $a_article->slug !!}"><span
                                        class="">{!! $loop->index + 1 !!}</span> {!! $a_article->title !!}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div id="item-no">第 {!! $article->volume->no !!} 卷</div>
        @endif
    @else
        <div id="item-no"><a href="/{!! $article_type !!}/{!! $article->volume->slug !!}">{!! "{$article->volume->no}  {$article->volume->name}"   !!}</a></div>
    @endif
@stop


@section('content')

    <div class="container">
        <main class="row middle">

            <article id="item" class="z-free">
                <header>
                    @if($article_type=='vol' && $article->type!='note')
                        <h1 id="item-title">{!!  $article->title !!}</h1>
                        @if($topQuotesCount = $article->topQuotes->count())
                            <style>

                                @if($person)
        .slick-dots > li:nth-child(-n+{!! $topQuotesCount !!}) {
                                    width: {!! 50/$topQuotesCount !!}%;
                                    border-bottom: 0.5px solid transparent !important;
                                    margin: 0;
                                }
                                @endif

                            </style>
                            <div id="item-first-page">
                                <div class="person-map">
                                    <div class="map"></div>
                                    <div class="person-addr"></div>
                                </div>
                                <section id="person-text">
                                    @foreach($article->topQuotes as $topQuote)
                                        <article class="person-quote-box">
                                            <blockquote class="person-quote">
                                                <p class="person-quote-body">{!! $topQuote->body !!}</p>
                                                <cite class="cite-tail-right"><a
                                                            href="{!! $topQuote->origin_url !!}">{!! $topQuote->author !!}</a></cite>
                                            </blockquote>
                                        </article>
                                    @endforeach

                                    @if($person)
                                        <?php
                                        $years90 = 90 * 365 * 24 * 60 * 60;
                                        function getExperienceTimeHtml($time, $level)
                                        {
                                            // A Guide to the HTML5 ‘time’ Element http://www.sitepoint.com/html5-time-element-guide/

                                            switch (strtoupper($level)) {
                                                case 'Y':
                                                    return sprintf('<time datetime="%1$s">%1$s</time>', substr($time, 0, 4));
                                                    break;
                                                case 'M':
                                                    return sprintf('<time datetime="%1$s-%2$s">%1$s.%2$s</time>', substr($time, 0, 4), substr($time, 5, 2));
                                                    break;
                                                case 'D':
                                                    return sprintf('<time datetime="%1$s-%2$s-%3$s">%1$s.%2$s</time>', substr($time, 0, 4), substr($time, 5, 2), substr($time, 8, 2));
                                                    break;
                                            }

                                        }
                                        $birth = $person->birthday;
                                        $birth_level = $person->birthday_level;
                                        $getAge = function ($time = null, $level = null) use (&$birth, &$birth_level) {
                                            $target_level = max(strtoupper($level), strtoupper($birth_level)); // 'd' 'm', 'y' 取最大的
                                            switch ($target_level) {
                                                case 'Y':
                                                    return substr($time, 0, 4) - substr($birth, 0, 4);
                                                    break;
                                                case 'M':
                                                    return substr($time, 0, 4) - substr($birth, 0, 4) - (substr($time, 5, 2) < substr($birth, 5, 2) ? 1 : 0);
                                                    break;
                                                case 'D':
                                                    return (new DateTime($time))->diff(new DateTime($birth))->format('%y');
                                                    break;
                                            }
                                        }
                                        ?>
                                        @foreach($experiences as $experience)
                                            @if($experience->display != 'normal')
                                                <?php
                                                $place = $experience->places[0];
                                                $expericenLeft[] = round((strtotime($experience->end_date) - strtotime($person->birthday)) / $years90 * 100, 2) / 2;
                                                $experienceCount[] = round((strtotime($experience->end_date) - strtotime($experience->start_date)) / $years90 * 100, 2) / 2;
                                                //                                                    echo $experience->intro,PHP_EOL;
                                                ?>
                                                <article class="person-map-intro">


                                                    <h1>
                                                        {!! $experience->intro !!}
                                                        <span class="p-age">{!! $getAge($experience->start_date, $experience->start_date_level).' — '.$getAge($experience->end_date,$experience->end_date_level) !!}</span>

                                                    </h1>
                                                    <div class="p-title">{!! $experience->title !!}</div>

                                                    <p class="p-info">

                                                    </p>
                                                </article>
                                            @endif
                                        @endforeach
                                    @endif
                                </section>
                                @if(isset($experienceCount))
                                    <script>
                                        var topQuotesCount =
                                                {!! $topQuotesCount !!}
                                        var experienceCount = {!!  json_encode($experienceCount )!!};


                                        //        $('#person-text')
                                        //                .width(function(){return $(this).width()})
                                        //                .height(function(){return $(this).height()+2}) // +2 : 得到的height不能反应.cite-tail占据的高度，故略微增加高度

                                        // person map and person slick
                                        !function () {


                                            var _swipe = false; // slide幻灯片的切换是由swipe引起则为'left'或'right'，由点击map或dots引起则为false

                                            var personSlick = $('#person-text').slick({
                                                autoplay: false,
                                                dots: true,
//                variableWidth: true, // 自定义每个幻灯片的宽度 .slick-slide{ width: ...px; }
                                                arrows: false,
                                                mobileFirst: false,
                                            }).on('swipe', function (event, slick, direction) {
                                                console.log('start swipe', direction)
                                                _swipe = direction;
                                            }).on('beforeChange', function (event, slick, currentSlide, nextSlide) {

                                                if (nextSlide - topQuotesCount == ZCMap.lastActivePlot) return;

//                console.log('to slide ', nextSlide)

                                                // 经测试，如果不使用timer，在鼠标快速经过多个plot时，会造成多个plot都变成红点;
                                                // 把timer设到了slide而非mapael的mouseenter上，或可应对slide快速切换的情况吧
                                                if (timerChangeNextPlot) {
                                                    clearTimeout(timerChangeNextPlot);
                                                }
                                                timerChangeNextPlot = setTimeout(makeCallbackForChangeNextPlot(nextSlide - topQuotesCount), 500);
                                            });
                                            var timerChangeNextPlot;
                                            var makeCallbackForChangeNextPlot = function (nextActivePlotID) {

                                                return function () {
                                                    if (nextActivePlotID == zcmap.lastActivePlot) return;

                                                    // 向right滑入最后一个，或向left滑入第一个地点，则进入特殊模式
                                                    if (_swipe == 'left' && nextActivePlotID == 0) {
                                                        zcmap.enterLeft();
                                                    } else if (_swipe == 'right' && nextActivePlotID == zcmap.all_plots_ids.length - 1) {
                                                        zcmap.enterRight();
                                                    }

                                                    zcmap.update(nextActivePlotID)

                                                    _swipe = false;

                                                }
                                            }

                                                    @if($experiences)
                                            var plots = {
                                            <?php $index = 0;function getPlaceName($place)
                                        {
                                            if ($place->pivot->place_name_en) {
                                                return "<z-lang lang=en title=\"$place->pivot->place_name\">$place->pivot->place_name_en</z-lang>";
                                            } elseif ($place->pivot->place_name) {
                                                return $place->pivot->place_name;
                                            } elseif ($place->name_en) {
                                                return "<z-lang lang=en title=\"$place->name\">$place->name_en</z-lang>";
                                            } else {
                                                return $place->name;
                                            }

                                        } ?>
                                            @foreach($experiences as $experience)
                                            @if($experience->display != 'normal')
                                            <?php $place = $experience->places[0];$all_plots_ids[] = $index; ?>
                                            {!! $index++ !!}:
                                            {
                                                latitude: '{!! $place->lat !!}', longitude
                                            :
                                                '{!! $place->lng !!}',
                                                    addr
                                            :
                                                '{!! getPlaceName($place) !!}<br><span class="p-date">{!! getExperienceTimeHtml($experience->start_date, $experience->start_date_level) .' - '. getExperienceTimeHtml($experience->end_date,$experience->end_date_level) !!}</span>',
                                                {{--                    intro: '{!! $experience->intro !!}',--}}
                                            }
                                        ,
                                            @endif
                                            @endforeach

                                        }
                                            ;


                                            $('#person-text>ul>li:lt({!! $topQuotesCount  !!})').each(function (index) {
                                                $(this).width((50 / topQuotesCount) + '%')
                                            })
                                            {{-- todo: 这个计算并不精确，因为每个段之间都有间距；考虑相邻段用不同颜色，但效果不好 --}}
                                            $('#person-text>ul>li:gt(  {!! $topQuotesCount-1 !!} )').each(function (index) {
                                                $(this).width(experienceCount[index] + '%')
                                            })

                                            zcmap = new ZCMap(
                                                {
                                                    ele: $(".person-map"),
                                                    plotsIDs: [<?php echo implode(',', $all_plots_ids)  ?>],
                                                    plots: plots,
                                                    config: {
                                                        mapName: 'world'
                                                    },
                                                    mouseoverCallback: function (e, id, mapElem, textElem, elemOptions) {
                                                        personSlick.slick('slickGoTo', parseInt(id) + topQuotesCount, true);
                                                    }
                                                },
                                                {},
                                            )
                                            zcmap.eleAddr = $('.person-map>.person-addr').eq(0);

                                            @endif

                                            // 其它屏下　包括 resize 等事件，需要调整这个数字
                                            $('.person-quote-body').each(function () {
                                                // body + tail 总高度大于父元素(误差1) 则addClass
                                                if (this.scrollHeight + this.nextElementSibling.offsetHeight - this.parentElement.offsetHeight > 1) {
                                                    $(this).addClass('long');
                                                }
                                            })

                                        }();
                                    </script>
                                @endif
                            </div>
                        @endif

                        <div class="item-info" {!! $article->origin_url?'data-url="'.$article->origin_url.'"':'' !!} >
                            <span>文：{!! $article->author?:$article->origin !!}</span>
                            @if($article->show_date)
                                <time pubdate
                                      datetime="{!! $article->origin_date !!}">{!! $article->origin_date !!}</time>
                            @endif
                        </div>
                        {{--@if($article->type=='note')--}}
                    @else
                        <h1 id="note-item-title"><span id="item-title-prefix">{!! ['note'=>'后记','review'=>'评论','select'=>'评集',][$article->type] !!}：</span>{!!  $article->title !!}</h1>

                        <div class="item-info right" {!! $article->origin_url?'data-url="'.$article->origin_url.'"':'' !!} >
                            <span>文：{!! $article->author !!}</span>
                            @if($article->show_date)
                                <time pubdate
                                      datetime="{!! $article->origin_date !!}">{!! $article->origin_date !!}</time>
                            @endif
                        </div>
                    @endif
                </header>
                <div id="body" class="{!! $article->type=='select'?'select-body':'' !!}">
                    {!! $article->body !!}
                </div>
                <span data-c="{!! $article->codes !!}"></span>
            </article>


            @if($article_type=='vol')
                <section id="V">

                    <div id="V-title">
                        真城 · {!! $column_name !!} &nbsp&nbsp 卷 <span id="V-no">{!! $article->volume->no !!}</span>
                    </div>
                    @foreach($article->volume->articles as $a_article)
                        <article class="Big-Href">
                            <header>
                                <h1 class="L-item-title{!! $a_article->type=='note'?' note-item-title':'' !!}">
                                    <a href="{!! $a_article->slug !!}">{!! $a_article->title !!}</a>
                                </h1>
                            </header>
                            <p class="L-item-body">{!! $a_article->intro !!}</p>
                            @if(! $loop->last)
                                <hr class="V-item-hr">
                            @endif
                        </article>
                    @endforeach

                </section>



                    {{--@if($article->tailQuotes->count())--}}
                    {{--<section id="quotes" class="supplement">--}}
                    {{--<h1>- &nbsp;&nbsp;&nbsp; 摘抄 &nbsp;&nbsp;&nbsp;-</h1>--}}
                    {{--<div id="quotes-body">--}}
                    {{--@foreach( $article->tailQuotes as $quote )--}}
                    {{--<blockquote>--}}
                    {{--<p>{!! $quote->body !!}</p>--}}
                    {{--<cite class="cite-tail"><a--}}
                    {{--href="{!! $quote->origin_url !!}">{!! $quote->author?:$quote->origin !!}</a></cite>--}}
                    {{--</blockquote>--}}
                    {{--@endforeach--}}
                    {{--</div>--}}
                    {{--</section>--}}
                    {{--@endif--}}


                    @if($suggests)
                        <section id="suggests" class="a-side">

                            <h1>- &nbsp;&nbsp;&nbsp; 文 &nbsp;&nbsp;&nbsp;-</h1>
                            <article id="suggests-body">
                                <ol>

                                    @foreach( $suggests as $suggest )
                                        <li>
                                            <cite><a href="{!! $suggest->origin_url !!}">{!! $suggest->title !!} </a>{!! $suggest->origin !!}
                                            </cite>

                                            <blockquote>
                                                <p>{!! $suggest->body !!}</p>
                                            </blockquote>
                                        </li>
                                    @endforeach
                                </ol>
                            </article>
                        </section>
                    @endif


            @endif

        </main>

    </div>
    <div class="container-fluid">
        <div class="row" id="suggest">

        </div>
    </div>
@stop


@section('script_b')
    <script>

        zc.content.init();

        $('cite', '#body').addClass('cite-tail');

        $('.ins').each(function () {
            // 连续的多个.ins 只给第一个添加hr
            if (this.previousElementSibling && !this.previousElementSibling.classList.contains('ins')) {
                var me = $(this);
                me.before('<hr class="ins-hr">');
            }
        });

        // .limit-height

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
            fix: true,
            containerDefaultHeight: 350,  // 容器缩小时的高度　optional, used for update fix status
        })

    </script>
@stop
