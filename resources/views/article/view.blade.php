@extends('layouts.base',['desc'=>$article->desc])

@section('content_top')
    @if($article_type=='book'||$article_type=='video')
        <div id="item-no"><a href="/{!! $article_type !!}/{!! $media->slug !!}">{!! "{$media->name}"   !!}</a></div>
    @elseif($article_type=='vol')
        @if($article->volume->articles->count()>0)
            <div id="item-no" class="dropdown">
                @if($article->volume->articles->count()==1)
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuV"
                            data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">卷 {!! $article->volume->no !!}
                    </button>
                @else
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuV"
                            data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">卷 {!! $article->volume->no !!}
                        <span class="caret" id="dropDownCaret"></span>
                    </button>

                    <ul class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuV">
                        @foreach($article->volume->articles as $a_article)
                            @if($article->id ==$a_article->id)
                                <li class="disabled">
                                    <a disabled href="{!! $a_article->slug !!}"><span
                                                class="">{!! $loop->index + 1 !!}</span> {!! $a_article->title !!}</a>
                                </li>
                            @else
                                <li>
                                    <a href="{!! $a_article->slug !!}"><span
                                                class="">{!! $loop->index + 1 !!}.</span> {!! $a_article->title !!}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>
        @else
            <div id="item-no">第 {!! $article->volume->no !!} 卷</div>
        @endif
    @else
        <div id="item-no"><a
                    href="/{!! $article_type !!}/{!! $article->volume->slug !!}">{!! "{$article->volume->no}  {$article->volume->name}"   !!}</a>
        </div>
    @endif
@stop


@section('content')


    <div class="container">

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
                        $mapDataByID = []; $IDs = [];
                        ?>
                        @if($article->places->count()>0)
                            @foreach($article->places as $place)
                                <?php $IDs[] = $place->id;  ?>
                                <?php
                                $mapDataByID[$place->id] = [
                                    'addr' => $place->pivot->place_name ?? $place->name ?? $place->name_en,
                                    'intro' => $place->pivot->intro];
                                ?>

                            @endforeach
                        @endif

                    </div>

                    @if($article->topQuote)
                        <style>

                            #top-quote-box {
                                margin: 60px 0 0 10px;

                            }

                            .top-quote {
                                border-left-width: 0px;
                                font-size: 15px;
                                padding: 0;
                            }


                        </style>
                        <section id="top-quote-box">
                            <blockquote class="top-quote">
                                {!! $article->topQuote->body !!}
                                <cite class="cite-tail-right"><a
                                            href="{!! $article->topQuote->origin_url !!}">{!! $article->topQuote->author !!}</a></cite>
                            </blockquote>
                        </section>
                    @endif
                </div>
            </div>


            <div class="col-sm-7 col-sm-pull-5">


                <article id="item" class="z-free">
                    <header>
                        @if($article_type=='vol')

                            @if($article->sub_title)
                                <h1 id="item-title">{!!  $article->title !!}
                                    <small> —— {!! $article->sub_title !!}</small>
                                </h1>
                            @else
                                <h1 id="item-title">{!!  $article->title !!}</h1>
                            @endif

                        @else
                            <h1 id="note-item-title"><span id="item-title-prefix">{!! ['review'=>'评论','select'=>'评集',][$article->type] !!}
                                    ：</span>{!!  $article->title !!}</h1>

                        @endif

                        <div class="item-info truncate">
                            @if($article->origin_url)
                                <span>文：<a href="{!! $article->origin_url !!}" target="_blank">
                                            {!! ($article->author?$article->author .' . ':''). $article->origin !!}</a>
                                    </span>
                            @else
                                <span>文：{!! ($article->author?$article->author .' . ':''). $article->origin !!}</span>
                            @endif
                            @if($article->show_date)
                                <time pubdate
                                      datetime="{!! $article->origin_date !!}">{!! $article->origin_date !!}</time>
                            @endif
                        </div>
                    </header>


                    <div id="body" class="{!! $article->type=='select'?'select-body':'' !!}">
                        {!! $article->body !!}
                    </div>
                    <span data-c="{!! $article->codes !!}"></span>
                </article>


                @if($article_type=='vol')
                    <section id="V">
                        <div id="V-title" class="supplement-title">
                            真城 · {!! $column_name !!} &nbsp&nbsp 卷 <span id="V-no">{!! $article->volume->no !!}</span>
                        </div>
                        @foreach($article->volume->articles as $a_article)
                            @if($article->id ==$a_article->id)
                                <article>
                                    <header>
                                        <h1 class="V-item-title">
                                            <a disabled href="{!! $a_article->slug !!}">
                                                {!! $a_article->title !!}{!! $a_article->sub_title?' —— '. $a_article->sub_title :'' !!}</a>
                                        </h1>
                                    </header>
                                    <p class="V-item-body">{!! $a_article->intro !!}</p>
                                    @if(! $loop->last)
                                        <hr class="V-item-hr">
                                    @endif
                                </article>
                            @else
                                <article class="Big-Href">
                                    <header>
                                        <h1 class="V-item-title">
                                            <a href="{!! $a_article->slug !!}">
                                                {!! $a_article->title !!}{!! $a_article->sub_title?' —— '. $a_article->sub_title :'' !!}</a>
                                        </h1>
                                    </header>
                                    <p class="V-item-body">{!! $a_article->intro !!}</p>
                                    @if(! $loop->last)
                                        <hr class="V-item-hr">
                                    @endif
                                </article>
                            @endif
                        @endforeach

                    </section>


                    @if($article->tailQuotes->count())
                        <section id="QSup" class="supplement">
                            <h1 class="supplement-title">- &nbsp;&nbsp;&nbsp; 摘抄 &nbsp;&nbsp;&nbsp;-</h1>
                            <div id="QSup-body">
                                @foreach( $article->tailQuotes as $quote )
                                    <blockquote>
                                        <p>{!! $quote->body !!}</p>
                                        <cite class="cite-tail"><a target="_blank"
                                                                   href="{!! $quote->origin_url !!}">{!! $quote->author .' '. $quote->origin !!}</a></cite>
                                    </blockquote>
                                @endforeach
                            </div>
                        </section>
                    @endif


                    @if($suggests)
                        <section id="SSup" class="a-side">

                            <h1 class="supplement-title">- &nbsp;&nbsp;&nbsp; 文 &nbsp;&nbsp;&nbsp;-</h1>
                            <article id="SSup-body">
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
        </div>

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
            // // 连续的多个.ins 只给第一个添加hr
            // if (this.previousElementSibling && !this.previousElementSibling.classList.contains('ins')) {
            //     var me = $(this);
            //     me.before('<hr class="ins-hr">');
            // }
            $(this).append('<span class="prefix-quote">引</span>');
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

        var plots = {

        @if($article->places->count()>0)
        @foreach($article->places as $place)
        {!! $place->id !!}:
        {
            latitude: '{!! $place->lat !!}', longitude
        :
            '{!! $place->lng !!}',
        }
        ,
        @endforeach
        @endif

        }
        ;

        @if($IDs)
        zc.sideMap.init({
            itemIDs:{!! json_encode($IDs) !!},
            plots: plots,

            side: {
                ele: $('#side'),
                //affixEle: $('#LMap-box'),
                //swipeBoxEle: $('#LMap-info-swipebox'), // for swipe, 如果直接在 #LMap-info上面swipe,会被Vue破坏
                infoEle: '#LMap-info',
                infoData:{!! json_encode($mapDataByID) !!},
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

        //# sourceURL=article
    </script>
@stop
