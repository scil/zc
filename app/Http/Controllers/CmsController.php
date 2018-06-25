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
        list($IDs, $plots,$articles) = \Cache::remember('home_data', 60 * 24, function () {

            $vols = Volume::with(['firstArticlesSimple.places'])->where('column_id', MENU_ITEMS['green']['id'])->orderBy('no', 'desc')->get();
            $IDs["/green"] = [];
            $plots["/green"] = [];
            foreach ($vols as $vol) {
                foreach ($vol->firstArticlesSimple as $item) {
                    if ($item->places->count() > 0) {
                        $a_place = $item->places[0];
                        $text = ($a_place->pivot->place_name ?? $a_place->name ?? $a_place->name_en).($a_place->pivot->title?" · ".$a_place->pivot->title:'');
                        $IDs["/green"][] = $item->id;
                        $plots["/green"][$item->id] = [
                            'latitude' => $a_place->lat,
                            'longitude' => $a_place->lng,
                            'tooltip' => ['content' => "<span style=\"font-weight:normal;\">{$item->title}</span><br><span style='font-size:90%'>{$item->sub_title}</span>"],
                            'text' => ['content' => $text,
//                                "position"=>'top',
                                'margin'=>[
                                    'x' => 4, 'y'=>-1
                                ],
                                "attrs"=>["font-size"=>12,"text-anchor"=>'start','opacity'=>0],
                                "attrsHover"=>["font-size"=>12,"text-anchor"=>'start','opacity'=>1,"fill"=>'#2461a3'],

                            ],
                            'href' => "/green/{$item->slug}",
                            'title' => $item->title,
                            'desc' => $item->desc,
                        ];
                    }
                }
            }

            foreach (['spirit', 'human/indiv'] as $url) {

                $quotes = Quote::with('places', 'quoteable')
                    ->orderBy('order', 'desc')
                    ->where('quoteable_type', 'App\Column')
                    ->where('quoteable_id', MENU_ITEMS[$url]['id'])
                    ->select(['id', 'order', 'slug', 'title', 'desc', 'body',
                        \DB::raw('if(isnull(body_long),0,if(body_long="",0,1)) as b_long'),
                        'origin_url', 'origin', 'author',
                        'image_id', 'quoteable_id', 'quoteable_type'])
                    ->get();
                $IDs["/$url"] = [];
                $plots["/$url"] = [];
                foreach ($quotes as $item) {
                    if ($item->places->count() > 0) {
                        $a_place = $item->places[0];
                        $text = ($a_place->pivot->place_name ?? $a_place->name ?? $a_place->name_en).($a_place->pivot->title?" · ".$a_place->pivot->title:'');
                        $IDs["/$url"][] = $a_place->id;
                        $plots["/$url"][$a_place->id] = [
                            'latitude' => $a_place->lat,
                            'longitude' => $a_place->lng,

                            'tooltip' => ['content' => "<span style=\"font-weight:normal;\">{$item->title}</span><br><span style='font-size:90%'>{$item->desc}</span>"],
                            'text' => ['content' => $text,
//                                "position"=>'top',
                                'margin'=>[
                                    'x' => 4, 'y'=>-1
                                ],
                                "attrs"=>["font-size"=>12,"text-anchor"=>'start','opacity'=>0],
                                "attrsHover"=>["font-size"=>12,"text-anchor"=>'start','opacity'=>1,"fill"=>'#2461a3'],

                            ],
                            'href' => "/$url/{$item->slug}",
                        ];
                    }

                }

            }

            return [json_encode($IDs), json_encode($plots),$plots['/green']];
        });
       $columnID = 0;
       $articleID=3;

        return view('home', compact('columnID','IDs','plots','articles','articleID'));
    }


    function viewColumnArticle($prefix, $slug)
    {
        $article_type = 'vol';
        $columnID = MENU_ITEMS[$prefix]['id'];
        $column_name = MENU_ITEMS[$prefix]['name'];

        $article = Article::with('volume', 'volume.articles', 'volume.person.experiences.places', 'quotes', 'topQuotes', 'tailQuotes', 'references')
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
        $title = $article->title . ' &nbsp;|&nbsp; ' . MENU_ITEMS[$prefix]['ctitle'];

        return view('article.view', compact('article',
            'columnID', 'column_name', 'article_type', 'suggests', 'links', 'person', 'experiences',
            'title'));
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
        $columnID = MENU_ITEMS['book']['id'];
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
        $columnID = MENU_ITEMS['video']['id'];
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
        $quote = Quote::with('quoteable')->where([
            ['slug', '=', $slug]
        ])->first();

        return $columnID = $quote->quoteable->id;

        return view('quote.view', compact('quote', 'columnID'));

    }

    function viewMediaSpecialQuote($slug, $type, $media_type)
    {
        $quote = Quote::with('quoteable')->where([
            ['slug', '=', $slug . '---' . $type]
        ])->first();

        $columnID = MENU_ITEMS['video']['id'];
        $media = $quote->quoteable;

        $title = $media->name . ' ' . $type;
        $desc = '';

        return view('quote.mediaSpecial', compact('quote', 'columnID', 'media', 'type', 'media_type', 'title', 'desc'));

    }

    function viewShanShuiQuote($prefix, $slug)
    {
        $quote = Quote::
        with(['places', 'image', 'quoteable' => function ($query) {
            $query->select('id');
        }])->
        where([
            ['slug', '=', $slug]
        ])->first();

        $title = $quote->title . ' &nbsp;|&nbsp; ' . MENU_ITEMS[$prefix]['ctitle'];
        $columnID = $quote->quoteable->id;

        return view('quote.view', compact('quote', 'columnID', 'title'));

    }


    function viewQuoteColumn($url)
    {
        $columnInfo = MENU_ITEMS[$url];
        $desc = $columnInfo['desc'];
        $columnID = $columnInfo['id'];
        $title = $columnInfo['title'];
        $columnCss = $columnInfo['css'] ?? null;

        if ($url === 'sail') {
            $columnLevel = 2;
            $quotes = Quote::with('places', 'image', 'quoteable')
                ->orderBy('order', 'desc')
                ->where('quoteable_type', 'App\Column')
                ->whereIn('quoteable_id', $columnInfo['q'])
                ->select(['id', 'order', 'slug', 'title', 'sub_title', 'body',
                    \DB::raw('if(isnull(body_long),0,if(body_long="",0,1)) as b_long'),
                    'origin_url', 'origin', 'author',
                    'image_id', 'quoteable_id', 'quoteable_type'])
                ->get();

        } else {
            $columnLevel = 3;

            $quotes = Quote::with('places', 'image')
                ->orderBy('order', 'desc')
                ->where([
                    'quoteable_type' => 'App\Column',
                    'quoteable_id' => $columnID,
                ])
                ->get();


            if (substr($url, 0, 3) == 'sai') {
                $url = 'sail';
//                $title = MENU_ITEMS['sail']['title'];
            }

        }

        return view('quoteList', compact('columnID', 'columnLevel', 'url', 'quotes',
            'columnCss', 'desc', 'title'));

    }

    function viewArticleColumn($url)
    {

        $columnInfo = MENU_ITEMS["$url"];
        $desc = $columnInfo['desc'];
        $title = $columnInfo['title'];
        $columnID = $columnInfo['id'];

        if (isset($columnInfo['a'])) { // has child columns with articles
            $columnLevel = 2;

            $vols = Volume::with(['column', 'firstArticlesSimple.places'])->whereIn('column_id', $columnInfo['a'])->orderBy('created_at', 'desc')->get();


        } else {

            $columnLevel = 3;

            $vols = Volume::with(['column', 'firstArticlesSimple.places'])->where('column_id', $columnInfo['id'])->orderBy('no', 'desc')->get();

        }

        return view('articleList', compact('columnID', 'columnInfo', 'vols', 'columnLevel', 'desc', 'title'));

    }

    public function testdb()
    {
        $columnInfo = MENU_ITEMS["green"];
        $desc = $columnInfo['desc'];
        $title = $columnInfo['title'];
        $columnLevel = 3;

        $vols = Volume::with(['column', 'firstArticlesSimple.places'])->where('column_id', $columnInfo['id'])->orderBy('no', 'desc')->get();

        $quotes = Quote::with('places')->where([
            ['quoteable_type', '=', 'App\Column'],
            ['quoteable_id', '=', $columnInfo['id']],
        ])->orderBy('order', 'desc')->get();

        $articles = $vols[0]->firstArticlesSimple();
//        var_dump($quotes);


        $file = '/home/vagrant/.tmp.tmp';
//        $fp = \swoole\mmap::open($file, 8192);
//        fwrite($fp, "hello world\n");
//        $abc= fread($fp,200);
        return view('testdb', compact('columnInfo', 'vols', 'quotes', 'columnLevel', 'desc', 'title', 'abc'));
        return view('mixedList', compact('columnInfo', 'vols', 'quotes', 'columnLevel', 'desc', 'title'));
    }

    function viewBook($slug = null)
    {
        $columnID = MENU_ITEMS['book']['id'];
        $media_type = 'book';

        if ($slug) {
            $media = Book::with(['tags', 'image', 'places', 'mediaQuotes', 'articles', 'comments', 'tip', 'errata', 'versions.tip', 'versions.errata'])->where('slug', $slug)->first();
            $title = $media->name . ' &nbsp;|&nbsp; ' . MENU_ITEMS['book']['ctitle'];
            $desc = $media->desc ?? substr($media->intro, 0, 200);
            return view('book.view', compact('media', 'columnID', 'title', 'desc'));
        } else {
            $title = MENU_ITEMS['book']['title'];
            $desc = MENU_ITEMS['book']['desc'];
            $vols = Volume::with('firstBooks.volume', 'firstBooks.places')->where('column_id', $columnID)->orderBy('no', 'desc')->get();
            $medias = $vols->map(function ($item, $key) {
                return $item->firstBooks[0];
            });
            return view('mediaList', compact('columnID', 'medias', 'media_type', 'title', 'desc'));
        }
    }

    function viewVideo($slug = null)
    {
        $columnID = MENU_ITEMS['video']['id'];
        $media_type = 'video';
        if ($slug) {
            $media = Video::with(['tags', 'image', 'places', 'mediaQuotes', 'comments', 'articles', 'tip', 'behind'])->where('slug', $slug)->first();
            $title = $media->name . ' &nbsp;|&nbsp; ' . MENU_ITEMS['video']['ctitle'];
            $desc = $media->desc ?? substr($media->intro, 0, 200);
            return view('book.view', compact('media', 'columnID', 'title', 'desc'));
        } else {
            $title = MENU_ITEMS['video']['title'];
            $desc = MENU_ITEMS['video']['desc'];

            $vols = Volume::with('firstVideos.volume', 'firstVideos.places')->where('column_id', $columnID)->orderBy('no', 'desc')->get();
            $medias = $vols->map(function ($item, $key) {
                return $item->firstVideos[0];
            });
            return view('mediaList', compact('columnID', 'medias', 'media_type', 'title', 'desc'));
        }
    }


}