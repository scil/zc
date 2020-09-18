<?php
/*
 routes are loaded by the RouteServiceProvider within a group which
 is assigned the "web" middleware group
 */

use App\Article;
use App\Jobs\ProcessPodcast;
use LaravelFly\Tools\LaravelJobByTask\TaskJobServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


$routesForAllLocalNoHome = function () {


//todo
//quote 必须在 article 前面，否则 human/so 不正常
// column
    Route::get('/{qlist_url}', 'CmsController@viewQuoteColumn')
        ->where('qlist_url', 'sky|human/(country|Indiv)|sail|sail/(walkers|wealth|road)');
//item
    Route::get('/{qprefix_url}/{slug}', 'CmsController@viewShanShuiQuote')
        ->where('qprefix_url', 'sky|human/(country|Indiv)|sail');


//article
// column
    Route::get('/{mlist_url}', 'CmsController@viewArticleColumn')->where('mlist_url', 'zhenyi|think|human|human/road|human/nature|zhen');
//item
    Route::get('/{prefix_url}/{slug}', 'CmsController@viewColumnArticle')->where('prefix_url', 'zhenyi|think|human|human/road|human/nature|zhen');

    Route::get('/article/{slug}', 'CmsController@viewColumnArticle');
    Route::get('/article/{slug}/edit', 'CmsController@editArticle');
    Route::put('/article/{id}', 'CmsController@putArticle');
    Route::delete('/article/{id}', 'CmsController@deleteArticle');

    Route::get('/q/{slug}', 'CmsController@viewQuote');


    Route::get('/book/{slug}/{sub}', 'CmsController@viewBookSub');
    Route::get('/video/{slug}/{sub}', 'CmsController@viewVideoSub');
    Route::get('/book/{slug?}', 'CmsController@viewBook');
    Route::get('/video/{slug?}', 'CmsController@viewVideo');

    Route::get('/country/{sub?}', 'CmsController@country');
    Route::get('/hall', 'CountryController@hall');
    Route::get('/bay/{sub?}', 'CountryController@bay');
    Route::get('/pass/{sub?}', 'CountryController@pass');
    Route::get('/ferry/{sub?}', 'CountryController@ferry');

    Route::get('/new_article', 'CmsController@createArticle');
    Route::post('/new_article', 'CmsController@storeArticle');

    Route::redirect('/green', '/zhenyi', 301);
    Route::redirect('/spirit', '/sky', 301);
    Route::redirect('/go', '/sky', 301);
    Route::redirect('/tree', '/bay', 301);
    Route::redirect('/tree/about', '/bay/about', 301);
    Route::get('/green/{slug}', function ($slug) {
        return redirect("/zhenyi'$slug", 301);
    });
    Route::get('/go/{slug}', function ($slug) {
        return redirect("/sky/$slug", 301);
    });

    Route::get('/being', function () {
        return redirect("/zhenyi", 301);
    });
    Route::get('/being/{slug}', function ($slug) {
        return redirect("/zhenyi/$slug", 301);
    });

    return;

    Route::get('/opcache', function () {
        $request = app()->make('request');

        if ($request->query('clear')) {
            opcache_reset();
            return back();
        }

//    ob_start();
        require __DIR__ . '/../storage/scripts/opcache-me.php';
//    $c = ob_get_clean();

//    return $c;

    });

    Event::listen('x', function (\Illuminate\Http\Request $request) {
        echo PHP_EOL, PHP_EOL, 'cid:', \Swoole\Coroutine::getuid();
        echo PHP_EOL, $request->getRequestUri(), PHP_EOL;
    });
    Route::get('/test', function () {
        $u = app('url')->full();
        Event::listen('x', function (\Illuminate\Http\Request $request) {
            echo '111', PHP_EOL;
        });
        \Swoole\Coroutine::sleep(6);
//    event('x', [app('request')]);
        return $u . "\n" . app('url')->full();
    });


    Route::get('/memoryInRouteClosure', function () {

        static $i = 0;
        $dif = memory_get_usage() - $i;
        $i = memory_get_usage();
        return $dif;
    });

    Route::get('/test', function () {
        $configLocale = \App::getLocale();
        $transLocale = app('translator')->getLocale();
        $newLocale = 'en';
        \App::setLocale($newLocale);
        $configLocale2 = \App::getLocale();
        $transLocale2 = app('translator')->getLocale();
        return "config: $configLocale -> $configLocale2; trans: $transLocale -> $transLocale2";

        Schema::dropIfExists('test_articles');
        Schema::create('test_articles', function ($table) {
            $table->enum('type', ['first', 'normal', 'note']);
        }
        );
        $items = [
            ['type' => 'first'],
            ['type' => 'note'],
            ['type' => 'first'],
            ['type' => 'normal'],
            ['type' => 'first'],
        ];

        foreach ($items as $item) {
            \DB::table('test_articles')->insert($item);
        }

        return \DB::table('test_articles')
            ->orderByRaw("FIELD(type, 'first', 'normal', 'note')")
//        ->orderBy('type')
            ->get(['type',]);

    });
    Route::get('/test2', function () {
        \Co::sleep(3);
        $configLocale = \App::getLocale();
        $transLocale = app('translator')->getLocale();
        return "config: $configLocale; trans: $transLocale";
    });


};


if (defined('LARAVELFLY_MODE'))
    // use '' for  'zh'
    $target = array_merge([''], array_diff(ALL_LOCALS, [DEFAULT_LOCAL]));
else
    // use '' for  'zh'
    $target = [LaravelLocalization::setLocale() ?: ''];


foreach ($target as $locale) {

    Route::get('/' . $locale, 'CmsController@home')->middleware($locale ? 'locale:' . $locale : 'localeForRoot');

    Route::get('/zh', 'CmsController@home')->middleware('locale:zh');

    Route::group(
        [
            'prefix' => $locale,
            'middleware' => [$locale ? 'locale:' . $locale : 'locale:zh'],
        ],
        $routesForAllLocalNoHome);
}


Route::get('/php', function () {
    ob_start();
    phpinfo();
    return ob_get_clean();
});

Route::get('/fly-tinker', function () {
    eval(tinker());
    return 3;
});
Route::get('/dd', function () {


//    return \Request::header();
    return \Request::header() . \Request::header('SERVER_ADDR') . 'abc';

    $configLocale = \App::getLocale();
    $transLocale = app('translator')->getLocale();
    $newLocale = 'en';
    \App::setLocale($newLocale);
    $configLocale2 = \App::getLocale();
    $transLocale2 = app('translator')->getLocale();
    return "config: $configLocale -> $configLocale2; trans: $transLocale -> $transLocale2";

    event(new \App\Events\TestEvent());
    return 3;
});

Route::get('/vvv/{v}', 'CmsController@test1');
