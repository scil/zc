<?php

namespace App\Http\Controllers;

use App\Video;
use App\Volume;
use App\Article;
use App\Quote;
use App\Book;


class CmsController extends Controller
{


    function home()
    {
        list($IDs, $plots, $articles) = \Cache::remember('home-data-'.app()->getLocale(), 60 * 24, function () {

            $columnUrl = HOMEPAGE_PLOTS_ARTICLE;
            $columnUrlPrefix = '/'.HOMEPAGE_PLOTS_ARTICLE;

            $vols = Volume::with(['firstArticlesSimple.places'])->where('column_id', MENU_MAP[$columnUrl]['id'])->orderBy('no', 'desc')->get();
            $IDs[$columnUrlPrefix] = [];
            $plots[$columnUrlPrefix] = [];
            foreach ($vols as $vol) {
                foreach ($vol->firstArticlesSimple as $item) {
                    if ($item->places->count() > 0) {
                        $a_place = $item->places[0];
                        $text = ($a_place->pivot->place_name ?? $a_place->name ?? $a_place->english_name) . ($a_place->pivot->title ? " · " . $a_place->pivot->title : '');
                        $IDs[$columnUrlPrefix][] = $item->id;
                        $plots[$columnUrlPrefix][$item->id] = [
                            'latitude' => $a_place->lat,
                            'longitude' => $a_place->lng,
                            'tooltip' => ['content' => "<span style=\"font-weight:normal;\">{$item->title}</span><br><span style='font-size:90%'>{$item->sub_title}</span>"],
                            'text' => ['content' => $text,
//                                "position"=>'top',
                                'margin' => [
                                    'x' => 4, 'y' => -1
                                ],
                                "attrs" => ["font-size" => 12, "text-anchor" => 'start', 'opacity' => 0],
                                "attrsHover" => ["font-size" => 12, "text-anchor" => 'start', 'opacity' => 1, "fill" => '#2461a3'],

                            ],
                            'href' => $columnUrlPrefix."/{$item->slug}",
                            'title' => $item->title,
                            'desc' => $item->desc,
                        ];
                    }
                }
            }

            foreach (HOMEPAGE_PLOTS_QUOTE as $url) {

                $quotes = Article::with('places', 'articleable')
                    ->orderBy('order', 'desc')
                    ->where('articleable_type', 'App\Column')
                    ->where('articleable_id', MENU_MAP[$url]['id'])
                    ->select(['id', 'order', 'slug',
                        //'title', 'desc', 'intro',
                        \DB::raw('if(short>2,1,0) as b_long'),
                        'origin_url', 'origin', 'author',
                        'image_id', 'articleable_id', 'articleable_type'])
                    ->get();
                $IDs["/$url"] = [];
                $plots["/$url"] = [];
                foreach ($quotes as $item) {
                    if ($item->places->count() > 0) {
                        $a_place = $item->places[0];
                        $text = ($a_place->pivot->place_name ?? $a_place->name ?? $a_place->english_name) . ($a_place->pivot->title ? " · " . $a_place->pivot->title : '');
                        $IDs["/$url"][] = $a_place->id;
                        $plots["/$url"][$a_place->id] = [
                            'latitude' => $a_place->lat,
                            'longitude' => $a_place->lng,

                            'tooltip' => ['content' => "<span style=\"font-weight:normal;\">{$item->title}</span><br><span style='font-size:90%'>{$item->desc}</span>"],
                            'text' => ['content' => $text,
//                                "position"=>'top',
                                'margin' => [
                                    'x' => 4, 'y' => -1
                                ],
                                "attrs" => ["font-size" => 12, "text-anchor" => 'start', 'opacity' => 0],
                                "attrsHover" => ["font-size" => 12, "text-anchor" => 'start', 'opacity' => 1, "fill" => '#2461a3'],

                            ],
                            'href' => "/$url/{$item->slug}",
                        ];
                    }

                }

            }

            return [json_encode($IDs), json_encode($plots), $plots['/being']];
        });
        $columnID = 0;
        $articleID = 29;

        return view('home', compact('columnID', 'IDs', 'plots', 'articles', 'articleID'));
    }


    function viewColumnArticle($prefix, $slug)
    {
        $article_type = 'vol';
        $columnID = MENU_MAP[$prefix]['id'];

        $article = Article::with('volume', 'volume.articles', 'volume.person.experiences.places', 'htmls', 'quotes', 'topQuotes.htmls', 'tailQuotes.htmls', 'references')
            ->where(
                'slug', $slug
            )->first();

        if ($article->topQuotes->count() > 0) {
            $article->topQuote = $article->topQuotes[0];
        }

        $person = $article->volume->person;
        $experiences = $person ? $person->experiences : null;

        $suggests = [];
        $links = [];
        foreach ($article->references as $ref) {
            $order = $ref->order;
            if ($order < 100) {
                $suggests[] = $ref;
            } else {
                $links[] = $ref;
            }
        }

        return view('article.view', compact('article',
            'columnID', 'article_type', 'suggests', 'links', 'person', 'experiences','prefix'));
    }

    function viewBookSub($slug, $sub)
    {
        if (in_array($sub, ['tip', 'behind', 'errata'])) {
            return $this->viewMediaSpecialQuote($slug, $sub, 'book');
        }
        $media = Book::with(['articles' => function ($q) use ($sub) {
            $q->where([
                ['slug', '=', $sub],
            ])->first();
        }])->where('slug', $slug)->first();
        $article = $media->articles[0];
        $article_type = 'book';
        // a simple title for article
        $columnID = MENU_MAP['book']['id'];
        $title = $article->title . ' &nbsp;|&nbsp; ' . $media->name . ' &nbsp;|&nbsp; 真城书架';
        return view('article.view', compact('columnID', 'article', 'article_type', 'media', 'title'));
    }

    function viewVideoSub($slug, $sub)
    {
        if (in_array($sub, ['tip', 'behind', 'errata'])) {
            return $this->viewMediaSpecialQuote($slug, $sub, 'video');
        }

        $media = Video::with(['articles' => function ($q) use ($sub) {
            $q->where([
                ['slug', '=', $sub],
            ])->first();
        }])->where('slug', $slug)->first();
        $article = $media->articles[0];
        $article_type = 'video';
        // a simple title for article
        $columnID = MENU_MAP['video']['id'];
        $title = $article->title . ' &nbsp;|&nbsp; ' . $media->name . ' &nbsp;|&nbsp; 真城视窗';
        return view('article.view', compact('columnID', 'article', 'article_type', 'media', 'title'));
    }


    function createArticle()
    {
        $columnID = 5;

        return view('article.create', compact('columnID'));
    }

    function putArticle($id)
    {
        Article::find($id)->update(\Input::except('_token'));
        return 'ok';
    }

    function deleteArticle($id)
    {
        Article::destroy($id);
    }

    function storeArticle()
    {
        Article::create(\Input::all());
        return 3;
    }

    function editArticle($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $columnID = $article->column_id;
        return view('article.create', compact('columnID', 'article'));
    }


    function viewQuote($slug)
    {
        $slug = 'beauty-in-her-eyes';
        $quote = Article::with('articleable')->where([
            ['slug', '=', $slug]
        ])->first();

        return $columnID = $quote->articleable->id;

        return view('quote.view', compact('quote', 'columnID'));

    }

    function viewMediaSpecialQuote($slug, $type, $media_type)
    {
        $quote = Article::with(['articleable', 'htmls' => function ($q) {
            $q->first();
        }])->where([
            ['slug', '=', $slug . '---' . $type]
        ])->first();

        $quote->body = $quote->htmls->body;

        $columnID = MENU_MAP['video']['id'];
        $media = $quote->articleable;

        $title = $media->name . ' ' . $type;
        $desc = '';

        return view('quote.mediaSpecial', compact('quote', 'columnID', 'media', 'type', 'media_type', 'title', 'desc'));

    }

    function viewShanShuiQuote($prefix, $slug)
    {
        $quote = Article::
        with(['places', 'image',
            'articleable' => function ($query) {
                $query->select('id');
            },
            'htmls'
        ])->
        where([
            ['slug', '=', $slug]
        ])->first();

        if ($quote->htmls->count() > 0)
            $quote->body_long = $quote->htmls[0]->body;

        $columnID = $quote->articleable->id;

        return view('quote.view', compact('quote', 'columnID','prefix'));

    }


    function viewQuoteColumn($url)
    {
        $columnInfo = MENU_MAP[$url];
        $columnID = $columnInfo['id'];
        $columnCss = $columnInfo['css'] ?? null;

        if ($url === SAIL_URL) {
            $columnLevel = 2;
            $quotes = Article::with('places', 'image', 'articleable')
                ->orderBy('order', 'desc')
                ->where('articleable_type', 'App\Column')
                ->whereIn('articleable_id', $columnInfo['q'])
                ->select(['id', 'order', 'slug',
                   // 'title', 'sub_title', 'intro',
                    \DB::raw('if(short>2,1,0) as b_long'),
                    'origin_url', 'origin', 'author',
                    'image_id', 'articleable_id', 'articleable_type'])
                ->get();
//            return $quotes;

        } else {
            $columnLevel = 3;

            $quotes = Article::with('places', 'image')
                ->orderBy('order', 'desc')
                ->where([
                    'articleable_type' => 'App\Column',
                    'articleable_id' => $columnID,
                ])
                ->get();


            if (substr($url, 0, 3) === 'sai') {
                $url = 'sail';
//                $title = MENU_MAP['sail']['title'];
            }

        }

        return view('quoteList',
            compact('columnID', 'columnLevel', 'url', 'quotes', 'columnCss'));

    }

    function viewArticleColumn($url)
    {

        $columnInfo = MENU_MAP[$url];
        $columnID = $columnInfo['id'];

        if (isset($columnInfo['a'])) { // has child columns with articles
            $columnLevel = 2;

            $vols = Volume::with([ 'firstArticlesSimple.places'])->whereIn('column_id', $columnInfo['a'])->orderBy('created_at', 'desc')->get();


        } else {

            $columnLevel = 3;

            $vols = Volume::with([ 'firstArticlesSimple.places'])->where('column_id', $columnInfo['id'])->orderBy('no', 'desc')->get();

        }

        return view('articleList', compact('columnID', 'columnInfo', 'vols', 'columnLevel', 'url'));

    }


    function viewBook($slug = null)
    {
        $columnID = MENU_MAP['book']['id'];
        $media_type = 'book';

        if ($slug) {
            $media = Book::with(['tags', 'image', 'places', 'mediaQuotes', 'articles', 'comments', 'tip', 'errata', 'versions.tip', 'versions.errata'])->where('slug', $slug)->first();
            return view('book.view', compact('media', 'columnID', 'media_type'));
        }

        $vols = Volume::with('firstBooks.volume', 'firstBooks.places')->where('column_id', $columnID)->orderBy('no', 'desc')->get();
        $medias = $vols->map(function ($item, $key) {
            return $item->firstBooks[0];
        });
        return view('mediaList', compact('columnID', 'medias', 'media_type'));
    }

    function viewVideo($slug = null)
    {
        $columnID = MENU_MAP['video']['id'];

        $media_type = 'video';
        if ($slug) {
            $media = Video::with(['tags', 'image', 'places', 'mediaQuotes', 'comments', 'articles', 'tip', 'behind'])->where('slug', $slug)->first();
            return view('book.view', compact('media', 'columnID', 'media_type'));

        }

        $vols = Volume::with('firstVideos.volume', 'firstVideos.places')->where('column_id', $columnID)->orderBy('no', 'desc')->get();
        $medias = $vols->map(function ($item, $key) {
            return $item->firstVideos[0];
        });
        return view('mediaList', compact('columnID', 'medias', 'media_type'));
    }


}