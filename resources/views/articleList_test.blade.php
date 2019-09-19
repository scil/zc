@extends('layouts.base'.$IS_PJAX,['title'=>MENU_ITEMS[$LOCALE][$url]['title'],'desc'=>MENU_ITEMS[$LOCALE][$url]['desc']])

@section('content')
    <div class="container">
        <div class="row" id="column-box">


            <div class="col-sm-7">
                <div id="L">
                    @foreach($vols as $vol)
                        @if($columnLevel==2)
                            <div class="vol">
                                @foreach($vol->firstArticlesSimple as $article)
                                    <article>
                                        <header class="L-item-header clearfix">
                                            <span class="prefix-col-name prefix-col-name-{!! $vol->column->css !!}">{!! MENU_ITEMS[$LOCALE][substr($vol->column->url,1)]['short_name'] !!}</span>
                                            <h1 class="L-item-title" id="{!! $article->id !!}">
                                                <a href="{!! $vol->column->url !!}/{!!  $article->slug !!}">
                                                    {!! $article->title !!}{!! $article->sub_title?' —— '. $article->sub_title :'' !!}</a>
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
                                                <span class="prefix-col-name  prefix-col-name-{!! MENU_MAP[$url]['css'] !!}">{!! $vol->no !!}</span>
                                                <span class="no-in-vol no-in-vol-1">{!! $loop->index + 1 !!}</span>
                                            @else
                                                <span class="no-in-vol">{!! $loop->index + 1 !!}</span>
                                            @endif
                                            <h1 class="L-item-title" id="{!! $article->id !!}"><a
                                                        href="/{!! $url !!}/{!!  $article->slug !!}">
                                                    {!! $article->title !!}{!! $article->sub_title?' —— '. $article->sub_title :'' !!}</a>
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
    </div>
@endsection

