<?php

namespace App\Providers;


use App\Services\Http2Push;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppWorker_ServiceProvider. this provider can be used for all requests in a swoole worker.
 * @package App\Providers
 */
class AppWorker_ServiceProvider extends ServiceProvider
{
    static function coroutineFriendlyServices(): array
    {
        return ['http2push'];
    }

    public function boot()
    {
        Paginator::useBootstrapThree();

        $push = app('http2push');
        $push->registerGulpProducedFilesWithToken();

    }

    public function register()
    {
        $this->app->singleton('http2push', function () {
            return new Http2Push();
        });

    }
}
