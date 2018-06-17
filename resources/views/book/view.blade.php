@extends('layouts.base',['title'=>$title])


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <h1 id="M-name">{!! $media->name !!} <small>{!! $media->tags->count()>0 ? $media->tags->implode('name',' / '):'' !!}</small></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <span class="caret" id="col-first-page-open"></span>
                <div id="col-first-page">
                    <button type="button" class="close" id="col-first-page-close" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">

                            <section id="MQL">
                                @foreach($media->mediaQuotes as $q)
                                    <article class="MQ-box">
                                        <blockquote class="MQ">
                                            <div class="MQ-body">
                                                {!! $q->body !!}
                                            </div>
                                            <cite class="MQ-cite"><a>{!! $q->origin!!}</a></cite>
                                        </blockquote>
                                    </article>
                                @endforeach
                            </section>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5 ">

                <div id="side">




                    <div id="M-info" class="one-line-height">

                        <div id="M-info-line" class="clearfix">
                            <div id="M-pic-box" class="pull-left"><img id="M-pic" src="{!! $media->image->url !!}"
                                                                       alt="{!! $media->image->alt !!}"{!! $media->image->style ? 'style="'.$media->image->style.'"':'' !!} >
                            </div>
                            <ul id="M-info-list" class="list-unstyled pull-left">
                                <li><span class="li-name">英名: </span>{!! $media->name_en !!}</li>
                                @if($media->other_names || $meida->names)
                                    <li>
                                        <span class="li-name">又名: </span>{!! $media->other_names !!} {!! $media->names !!}
                                    </li>
                                @endif
                                <li><span class="li-name">作者: </span>{!! $media->author !!}</li>
                                <li><span class="li-name">时间: </span>
                                    <time datetime="{!! $media->time !!}">{!! $media->time ?? $media->date !!}</time>
                                </li>
                            </ul>

                        </div>
                        <div id="M-intro" class="md-code">{!! $media->intro !!}</div>


                    </div>


                    <section id="MCL">

                        @foreach($media->comments as $comment)
                            <article class="MC-box">
                                <blockquote class="MC">
                                    <div class="MC-body">
                                        {!! $comment->body !!}
                                    </div>
                                    <cite class="MC-cite">{!! $comment->author ?? $comment->origin!!}</cite>
                                </blockquote>
                            </article>

                        @endforeach

                    </section>


                </div>
            </div>


            <div class="col-sm-7">


                <section id="MAL">
                    @foreach($media->articles as $article)
                        <article>
                            <header class="L-item-header clearfix">
                                <span class="prefix-col-name prefix-col-name-{!! $article->type !!}"></span>
                                <h1 class="L-item-title" id="{!! $article->id !!}"><a
                                            href="{!!$media->slug.  '/'.$article->slug !!}">{!! $article->title !!}</a>
                                </h1>
                            </header>
                            <p>{!! $article->intro !!}</p>
                        </article>
                        <hr class="L-item-hr">
                    @endforeach
                </section>

                <div id="M-guide">

                    @foreach(['tip','errata','behind'] as $type)
                        @if($media->$type)
                            <article>
                                <header class="L-item-header">
                                    <h1 class="L-item-title"><a class="M-guide-title" href="{!! $media->slug.'/'.$type !!}">{!! $type !!}</a>
                                    </h1>
                                </header>
                                <div class="QL-item-body">{!! $media->$type->body !!} </div>
                                @if($media->$type->body_long)
                                    <div class="QL-read-more-box">
                                        <a class="QL-read-more btn btn-sm"
                                           href="{!! $media->slug .'/'. $type !!}"></a>
                                    </div>
                                @endif
                            </article>
                            <hr class="L-item-hr">
                        @endif
                    @endforeach

                    @if($media->versions)
                        <article>
                            <header class="L-item-header">
                                <h1 class="L-item-title"><a class="M-guide-title"
                                                            >Versions</a></h1>
                            </header>
                            <table class="table table-bordered  table-hover" id="M-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>V</th>
                                    <th>Tip</th>
                                    <th>Errata</th>
                                    <th>I</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($media->versions as $v)
                                    <tr>
                                        <td>{!! $v->order !!}</td>
                                        <td>{!! $v->name !!}
                                            <div>
                                                {!! $v->intro !!}
                                            </div>
                                        </td>
                                        <td>{!! $v->tip? $v->tip->body:'' !!}</td>
                                        <td>@if($v->errata)
                                               {!! $v->errata->body !!}
                                                @if($v->errata->body_long)
                                                    <div class="table-read-more-box">
                                                        <a class="QL-read-more btn btn-sm"
                                                        href="{!! $v->slug .'/errata' !!}"></a>
                                                    </div>
                                                @endif
                                                @endif
                                            </td>
                                        <td>{!! $v->integrity !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </article>
                    @endif

                </div>

                <div id="M-map-box">

                        <div id="side-first-page">
                            <div class="map"></div>
                        </div>


                        <div id="LMap-info-swipebox">
                            <section id="LMap-info">
                                <p id="LMap-info-title" v-html="title"></p>
                                <div id="LMap-info-intro" v-html="intro"></div>
                            </section>
                        </div>
                        <?php
                        $mapInfosByID = []; $IDs = [];
                        ?>
                        @foreach($media->places as $place)
                            <?php $IDs[] = $place->id;  ?>
                            <?php
                            $mapInfosByID[$place->id] = [
                                'title' => $place->pivot->title,
                                'intro' => $place->pivot->intro]
                            ?>

                        @endforeach

                    </div>
            </div>
        </div>
    </div>
    </div>
@stop
@section('bottom')
    <script>


                @if($IDs)
        var plots = {
        @foreach($media->places as $place)
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

        var bookMap = new ZCMap(
            {
                ele: $("#side-first-page"),
                plotsIDs: {!! json_encode($IDs) !!},
                plots: plots,
                config: {
                    plotSize: 15,
                },// plotColor:'#8800CC'},
                mouseoverCallback: function (e, id, mapElem, textElem, elemOptions) {
                },
                autoLightFirst: true,
            },
            {
                ele: '#LMap-info',
                data: {!! json_encode($mapInfosByItemID) !!},
                infoSwipeBox: '#LMap-info-swipebox' // 不需要ZCMap提供的swipe 自定义swipe
            },
        )
                @endif

        var personSlick = $('#MQL').slick({
                autoplay: false,
                dots: true,
                    appendDots:$('#col-first-page'),
//                variableWidth: true, // 自定义每个幻灯片的宽度 .slick-slide{ width: ...px; }
                arrows: false,
                mobileFirst: true,
                adaptiveHeight: true,
            })

        zc.content.init();

        $('#col-first-page-close').click(function () {
            $(this).parent().slideUp(1000, function () {
                $(this).prev().show()
            });
        })
        $('#col-first-page-open').click(function () {
            $(this).hide().next().slideDown();
        })
    </script>
@endsection
