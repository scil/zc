<?php
/**
 *
 * y
 * Date: 2015/10/19
 * Time: 9:32
 */

namespace App\Http\Controllers;

use App\Video;
use App\Volume;
use App\Article;
use App\Quote;
use App\Book;

if (!defined('MENU_ITEMS')) {
    include storage_path() . '/staticizer/columns.php';
}

class CmsController extends Controller
{


    function home()
    {
        return view('home');
    }


    function viewColumnArticle($prefix, $slug)
    {
        $article_type = 'vol';
        $column_id = MENU_ITEMS[$prefix]['id'];
        $column_name = MENU_ITEMS[$prefix]['name'];

        $article = Article::with('volume', 'volume.articles', 'volume.person.experiences.places', 'quotes', 'topQuotes', 'tailQuotes', 'references')
            ->where(
                'slug', $slug
            )->first();

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
        return view('article.view', compact('article', 'column_id', 'column_name', 'article_type', 'suggests', 'links', 'person', 'experiences', 'title'));
    }

    function viewBookArticle($slug, $a_slug)
    {
        $media = Book::with(['articles' => function ($q) use ($a_slug) {
            $q->where([
                ['slug', '=', $a_slug],
            ])->first();
        }])->where('slug', $slug)->first();
        $article = $media->articles[0];
        $article_type = 'book';
        // a simple title for article
        $column_id = '_' . MENU_ITEMS['book']['id'];
        $title = $article->title . ' &nbsp;|&nbsp; ' . $media->name . ' &nbsp;|&nbsp; 真城书架';
        return view('article.view', compact('column_id', 'article', 'article_type', 'media', 'title'));
    }

    function viewVideoArticle($slug, $a_slug)
    {
        $media = Video::with(['articles' => function ($q) use ($a_slug) {
            $q->where([
                ['slug', '=', $a_slug],
            ])->first();
        }])->where('slug', $slug)->first();
        $article = $media->articles[0];
        $article_type = 'video';
        // a simple title for article
        $column_id = '_' . MENU_ITEMS['video']['id'];
        $title = $article->title . ' &nbsp;|&nbsp; ' . $media->name . ' &nbsp;|&nbsp; 真城视窗';
        return view('article.view', compact('column_id', 'article', 'article_type', 'media', 'title'));
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
        $slug='beauty-in-her-eyes';
        $quote = Quote::with('quoteable')->where([
            ['slug', '=', $slug]
        ])->first();

        return $column_id = $quote->quoteable->id;

        return view('quote.view', compact('quote', 'column_id'));

    }

    function viewBookSpecialQuote($slug, $type)
    {
        return $this->viewMediaSpecialQuote($slug, $type, 'book');
    }

    function viewVideoSpecialQuote($slug, $type)
    {
        return $this->viewMediaSpecialQuote($slug, $type, 'video');
    }

    function viewMediaSpecialQuote($slug, $type, $media_type)
    {
        $quote = Quote::with('quoteable')->where([
            ['slug', '=', $slug . '---' . $type]
        ])->first();

        $column_id = MENU_ITEMS['video']['id'];
        $media = $quote->quoteable;

        $title = $media->name . ' ' . $type;
        $desc = '';

        return view('quote.mediaSpecial', compact('quote', 'column_id', 'media', 'type', 'media_type', 'title', 'desc'));

    }

    function viewShanShuiQuote($prefix, $slug)
    {
        $quote = Quote::
        with(['quoteable' => function ($query) {
            $query->select('id');
        }])->
        where([
            ['slug', '=', $slug]
        ])->first();

        $title = $quote->title . ' &nbsp;|&nbsp; ' . MENU_ITEMS[$prefix]['ctitle'];
        $column_id = $quote->quoteable->id;

        return view('quote.view', compact('quote', 'column_id', 'title'));

    }


    function viewQuoteColumn($url)
    {
        $columnInfo = MENU_ITEMS[$url];
        $desc = $columnInfo['desc'];
        if ($url == 'two-rivers') {
            $title = $columnInfo['title'];
            $columnLevel = 2;
            $columnID = $columnInfo['id'];
            $quotes = Quote::with('places', 'image', 'quoteable')
                ->orderBy('order', 'desc')
                ->where('quoteable_type', 'App\Column')
                ->whereIn('quoteable_id', $columnInfo['q'])
                ->get();
            return view('quoteList', compact('columnID', 'columnLevel', 'url', 'quotes', 'desc', 'title'));

        } else {
            $columnLevel = 3;
            $columnID = $columnInfo['id'];
            $columnCss = $columnInfo['css'];

            $quotes = Quote::with('places', 'image')
                ->orderBy('order', 'desc')
                ->where([
                    'quoteable_type' => 'App\Column',
                    'quoteable_id' => $columnID,
                ])
                ->get();

            $title = $columnInfo['title'];

            if (substr($url, 0, 3) == 'two') {
                $url = 'two-rivers';
//                $title = MENU_ITEMS['two-rivers']['title'];
            }


            return view('quoteList', compact('columnID', 'columnLevel', 'columnCss', 'url', 'quotes', 'desc', 'title'));
        }


    }

    function mixedColumn($url)
    {

        $columnInfo = MENU_ITEMS["$url"];
        $desc = $columnInfo['desc'];
        $title = $columnInfo['title'];

        if (isset($columnInfo['a'])) {
            $columnLevel = 2;

            $vols = Volume::with(['column', 'firstArticlesSimple.places'])->whereIn('column_id', $columnInfo['a'])->orderBy('created_at', 'desc')->get();

            $quotes = [];


        } else {

            $columnLevel = 3;

            $vols = Volume::with(['column','firstArticlesSimple.places'])->where('column_id', $columnInfo['id'])->orderBy('no', 'desc')->get();

            $quotes = Quote::with('places')->where([
                ['quoteable_type', '=', 'App\Column'],
                ['quoteable_id', '=', $columnInfo['id']],
            ])->orderBy('order', 'desc')->get();


        }

        return view('mixedList', compact('columnInfo', 'vols', 'quotes', 'columnLevel', 'desc', 'title'));

    }
    public function testdb(){
        $columnInfo = MENU_ITEMS["green"];
        $desc = $columnInfo['desc'];
        $title = $columnInfo['title'];
        $columnLevel = 3;

        $vols = Volume::with(['column','firstArticlesSimple.places'])->where('column_id', $columnInfo['id'])->orderBy('no', 'desc')->get();

        $quotes = Quote::with('places')->where([
            ['quoteable_type', '=', 'App\Column'],
            ['quoteable_id', '=', $columnInfo['id']],
        ])->orderBy('order', 'desc')->get();

        $articles= $vols[0]->firstArticlesSimple();
//        var_dump($quotes);


        $file = '/home/vagrant/.tmp.tmp';
//        $fp = \swoole\mmap::open($file, 8192);
//        fwrite($fp, "hello world\n");
//        $abc= fread($fp,200);
        return view('testdb', compact('columnInfo', 'vols', 'quotes', 'columnLevel', 'desc', 'title','abc'));
        return view('mixedList', compact('columnInfo', 'vols', 'quotes', 'columnLevel', 'desc', 'title'));
    }

    function viewBook($slug = null)
    {
        $column_id = MENU_ITEMS['book']['id'];
        $media_type = 'book';

        if ($slug) {
            $media = Book::with(['tags', 'image', 'places', 'mediaQuotes', 'articles', 'comments', 'tip', 'errata', 'versions.tip', 'versions.errata'])->where('slug', $slug)->first();
            $title = $media->name . ' &nbsp;|&nbsp; ' . MENU_ITEMS['book']['ctitle'];
            $desc = $media->desc ?? substr($media->intro, 0, 200);
            return view('book.view', compact('media', 'column_id', 'title', 'desc'));
        } else {
            $title = MENU_ITEMS['book']['title'];
            $desc = MENU_ITEMS['book']['desc'];
            $vols = Volume::with('firstBooks.volume', 'firstBooks.places')->where('column_id', $column_id)->orderBy('no', 'desc')->get();
            $medias = $vols->map(function ($item, $key) {
                return $item->firstBooks[0];
            });
            return view('mediaList', compact('column_id', 'medias', 'media_type', 'title', 'desc'));
        }
    }

    function viewVideo($slug = null)
    {
        $column_id = MENU_ITEMS['video']['id'];
        $media_type = 'video';
        if ($slug) {
            $media = Video::with(['tags', 'image', 'places', 'mediaQuotes', 'comments', 'articles', 'tip', 'behind'])->where('slug', $slug)->first();
            $title = $media->name . ' &nbsp;|&nbsp; ' . MENU_ITEMS['video']['ctitle'];
            $desc = $media->desc ?? substr($media->intro, 0, 200);
            return view('book.view', compact('media', 'column_id', 'title', 'desc'));
        } else {
            $title = MENU_ITEMS['video']['title'];
            $desc = MENU_ITEMS['video']['desc'];

            $vols = Volume::with('firstVideos.volume', 'firstVideos.places')->where('column_id', $column_id)->orderBy('no', 'desc')->get();
            $medias = $vols->map(function ($item, $key) {
                return $item->firstVideos[0];
            });
            return view('mediaList', compact('column_id', 'medias', 'media_type', 'title', 'desc'));
        }
    }

    function country($sub = null)
    {
        if (is_null($sub)) {
            $column_id = MENU_ITEMS['country']['id'];
            $title = MENU_ITEMS['country']['title'];
            return view('country.index', compact('title'));
        }
        $column_id = MENU_ITEMS["country/$sub"]['id'];
        $title = MENU_ITEMS["country/$sub"]['title'];
        $desc = MENU_ITEMS["country/$sub"]['desc'];
        $data = [];
        return view("country.$sub", compact('column_id', 'title','desc'));
    }

    function hall()
    {

        $column_id = MENU_ITEMS["hall"]['id'];

            $title = MENU_ITEMS["hall"]['title'];
        $desc = MENU_ITEMS["hall"]['desc'];
        return view("country.hall", compact('column_id', 'title','desc'));
    }

    function pass($sub = null)
    {
        if (is_null($sub)) {
            return view('pass.index');
        }
        $data = [
            'title' => MENU_ITEMS["pass"]['title'],
            'desc' => MENU_ITEMS["pass"]['desc']];
        return view('pass.' . $sub, $data);
    }

    function ferry()
    {
        $data = [
            'title' => MENU_ITEMS["ferry"]['title'],
            'desc' => MENU_ITEMS["ferry"]['desc'],
        ];
        return view('pass.ferry', $data);
    }

}