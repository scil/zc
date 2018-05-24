<?php
/*
 routes are loaded by the RouteServiceProvider within a group which
 is assigned the "web" middleware group
 */

use App\Quote;
use App\Volume;

Route::get('/', 'CmsController@home');

//todo
//quote 必须在 article 前面，否则 human/raindrops 不正常
// column
Route::get('/{qlist_url}', 'CmsController@viewQuoteColumn')
    ->where('qlist_url', 'spirit|human/raindrops|sail|sail/(walkers|assets|dao)');
//item
Route::get('/{qprefix_url}/{slug}', 'CmsController@viewShanShuiQuote')
    ->where('qprefix_url', 'spirit|human/raindrops|sail');

//article
// column
Route::get('/{mlist_url}', 'CmsController@viewArticleColumn')->where('mlist_url', 'green|writing|human|human/road|human/nature|zhen');
//item
Route::get('/{prefix_url}/{slug}', 'CmsController@viewColumnArticle')->where('prefix_url', 'green|writing|human|human/road|human/nature|zhen');

Route::get('/article/{slug}', 'CmsController@viewColumnArticle');
Route::get('/article/{slug}/edit', 'CmsController@editArticle');
Route::put('/article/{id}', 'CmsController@putArticle');
Route::delete('/article/{id}', 'CmsController@deleteArticle');

Route::get('/q/{slug}', 'CmsController@viewQuote');


Route::get('/book/{slug}/a/{a_slug}', 'CmsController@viewBookArticle');
Route::get('/video/{slug}/a/{a_slug}', 'CmsController@viewVideoArticle');
Route::get('/book/{slug}/{type}', 'CmsController@viewBookSpecialQuote')->where('type', 'tip|behind|errata');
Route::get('/video/{slug}/{type}', 'CmsController@viewVideoSpecialQuote')->where('type', 'tip|behind');
Route::get('/book/{slug?}', 'CmsController@viewBook');
Route::get('/video/{slug?}', 'CmsController@viewVideo');

Route::get('/country/{sub?}', 'CmsController@country');
Route::get('/hall', 'CmsController@hall');
Route::get('/pass/{sub?}', 'CmsController@pass');
Route::get('/ferry/{sub?}', 'CmsController@ferry');

Route::get('/new_article', 'CmsController@createArticle');
Route::post('/new_article', 'CmsController@storeArticle');

Route::get('/test', function () {
    $i = new \App\MenuItemHelper();
    $i->getAllItems();
});

Route::get('/people', function () {
    return redirect("/green", 301);
});
Route::get('/people/{slug}', function ($slug) {
    return redirect("/green/$slug", 301);
});


Route::get('/php', function () {
    ob_start();
    phpinfo();
    return ob_get_clean();
});


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
Route::get('/test2', function () {
    Event::listen('x', function (\Illuminate\Http\Request $request) {
        echo '2222', PHP_EOL;
    });
//    event('x', [app('request')]);
    return app('url')->full();

});

Route::get('/fly', function () {

//    file_put_contents(storage_path('framework/down'), json_encode([
//                'time' => Carbon::now()->getTimestamp(),
//                'message' => Request::get('message',null),
//                'retry' => Request::get('retry',null),
//            ], JSON_PRETTY_PRINT)
//    );
    Artisan::call('down');
    app()->getServer()->setMemory('isDown', Request::get('down', 0));
    return 0;


    $file = storage_path('cofifle');
    $file = '/home/vagrant/mmap';
    //file_put_contents($file,'abc');
//    $n = \Co::writeFile($file, 'abc');
    $size = 8192;
    if (!is_file($file)) {
        file_put_contents($file, str_repeat("\0", $size));
    }
    $fp = \swoole\mmap::open($file, 8192);

    fwrite($fp, "hello world\n");
    fwrite($fp, "hello swoole\n");

    fflush($fp);
    fclose($fp);

    echo ':', getmypid(), "\n";
});

Route::get('/dbc', 'CmsController@testdb');

Route::get('/db', function () {
    $d = app()->make('db');
//    $names = $d->table('menu_items')->select('url','id')->where('id', '>', 12)->get();

//    $vols = Volume::with(['column'])->whereIn('column_id', [5,4])->get();
    //$vols = Volume::where('column_id','=', 4)->get();
    //todo
//simple
    $vols = Volume::where('column_id', '=', 4)->get();
    return $vols;

    $slug = 'beauty-in-her-eyes';
    $quote = Quote::with('quoteable')->where([
        ['slug', '=', $slug]
    ])->first();
    return $quote;

//$affected = DB::update('update menu_items set url = "/ferry3" where id = ?', [21]);return $affected;

//$names= DB::insert('insert into menu_items ( name,level,order,url) values (?, ?,?,?)', [ 'Dayle',0,1,'-kkk']);

//    $names = DB::delete('delete from menu_items where id>21');
    return $names . 'ok';
    return $names->url;
});
