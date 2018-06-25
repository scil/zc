<?php
/**
 * User: scil
 * Date: 2018/6/24
 * Time: 17:17
 */

namespace App\Providers;


use App\Services\Http2Push;
use Illuminate\Support\ServiceProvider;

class WorkerAppServiceProvider extends ServiceProvider
{
    static function coroutineFriendlyServices()
    {
        return ['http2push'];
    }

    public function boot()
    {
        $push = app('http2push');
        $push->registerGulpFiles();

    }

    public function register()
    {
        $this->app->singleton('http2push', function () {
            return new Http2Push();
        });

    }
}