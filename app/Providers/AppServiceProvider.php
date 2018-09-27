<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::share('IS_PJAX', $this->app->make('request')->header('x-pjax', ''));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole() || defined('LARAVELFLY_MODE'))
            $this->registerMarkdownServiceClient();
    }

    function registerMarkdownServiceClient()
    {
        $GEN_DIR = base_path() . '/thrift/gen-php/';
        $PORT = 7911;

        try {
            include_once $GEN_DIR . 'MarkdownService.php';
            include_once $GEN_DIR . 'Types.php';

            $socket = new TSocket('localhost', $PORT);

            $transport = new TBufferedTransport($socket, 1024, 1024);
            $protocol = new TBinaryProtocol($transport);
            $client = new \MarkdownServiceClient($protocol);

            $transport->open();
            app()->instance('markdown', $client);
        } catch (\Throwable $e) {
            \Log::emergency('thrift MarkdownService: ' . $e->getMessage());
        }
    }
}
