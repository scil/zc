@extends('layouts.base',['title'=>$title])

@section('content')

    <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <h1 id="M-name">
                        <a href="/{!! $media_type !!}/{!! $media->slug !!}">{!! $media->name !!}</a>
                        <small>{!! $type !!}</small></h1>
                </div>
            </div>
        @if($quote->body_long)
            <main class="row middle">
                <article id="item" class="z-free">

                    {{--<header>--}}
                        {{--<h1 id="item-title">{!!  $quote->title !!}</h1>--}}
                        {{--<div class="item-info" {!! $quote->origin_url?'data-url="'.$quote->origin_url.'"':'' !!} >--}}
                            {{--@if($quote->show_date)--}}
                                {{--<time pubdate--}}
                                      {{--datetime="{!! $quote->origin_date !!}">{!! $quote->origin_date !!}</time>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</header>--}}
                    <div id="body">
                        {!! $quote->body_long !!}
                    </div>
                    <span data-c="{!! $quote->codes !!}"></span>
                </article>
            </main>
        @else
            <main class="row middle-for-item-quote">

                <article class="z-free">
                    {{--<header>--}}
                    {{--<h1 id="item-title">{!!  $quote->title !!}</h1>--}}
                    {{--</header>--}}
                    <blockquote id="quote-item-first-page">
                        {!! $quote->body_long ?? $quote->body !!}
                        <cite class="cite-tail-right quote-item-cite"><a target="_blank"
                                                                         href="{!! $quote->origin_url !!}">{!! $quote->author !!}</a></cite>
                    </blockquote>
                    <span data-c="{!! $quote->codes !!}"></span>
                </article>


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
@stop


@section('bottom')
    <script>


        zc.content.init();

    </script>
@stop
