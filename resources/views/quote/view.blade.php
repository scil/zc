@extends('layouts.columns._'.$column_id,['title'=>$title,'desc'=>$quote->desc])

@section('content')

    <div class="container">
        <div id="item-no">NO. {!! $quote->order !!}</div>
        @if($quote->body_long)
            <main class="row middle">
                <article id="item" class="z-free">

                    <header>
                        <h1 id="item-title">{!!  $quote->title !!}</h1>
                        <div class="item-info" {!! $quote->origin_url?'data-url="'.$quote->origin_url.'"':'' !!} >
                            <span>文：{!! $quote->author?:$quote->origin !!}</span>
                            @if($quote->show_date)
                                <time pubdate
                                      datetime="{!! $quote->origin_date !!}">{!! $quote->origin_date !!}</time>
                            @endif
                        </div>
                    </header>
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


@section('script_b')
    <script>


        zc.content.init();

    </script>
@stop
