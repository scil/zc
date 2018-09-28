<?php

if (!defined('LARAVELFLY_MODE')) return [];

$IN_PRODUCTION = env('APP_ENV') === 'production' || env('APP_ENV') === 'product';

use Illuminate\Contracts\Auth\Access\Gate as GateContract;

return [
    'web' => [
        'enable' => true,
        'prefix' => 'laravel-fly',
    ],

    /**
     * If use cache file for config/laravel.php always.
     *
     * If true, Laravelfly will always use cache file
     *  laravelfly_ps_map.php
     * or
     *  laravelfly_ps_simple.php
     * and laravelfly_aliases.php
     * under bootstrap/cache/ when the files exist. If not exist, Laravelfly will create them.
     *
     * It's better to set it to false in dev env , set true and run `php artisan config:clear` before starting LaravelFly in production env
     */
    'config_cache_always' => $IN_PRODUCTION,
//    'config_cache_always' => true,

    /**
     * For each worker, if a view file is compiled max one time.
     *
     * If true, Laravel not know a view file changed until the swoole workers restart.
     * It's good for production env.
     */
    'view_compile_1' => $IN_PRODUCTION && LARAVELFLY_SERVICES['view.finder'],

    /**
     * useless providers.
     *
     * These providers are useless if they are not enabled in
     * config('laravelfly.providers_on_worker') or
     * config('laravelfly.providers_in_request')
     *
     * There providers will be removed from config('app.providers')
     */
    'providers_ignore' => array_merge([

        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Laravel\Tinker\TinkerServiceProvider::class,
        Fideloper\Proxy\TrustedProxyServiceProvider::class,
        LaravelFly\Providers\ServiceProvider::class,
        'Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider',

    ],
        $IN_PRODUCTION ? [
            'Barryvdh\\Debugbar\\ServiceProvider',
        ] : [

//        //test
//        NunoMaduro\Collision\Adapters\Laravel\CollisionServiceProvider::class,
////        App\Providers\AuthServiceProvider::class ,
//        App\Providers\BroadcastServiceProvider::class,
//        App\Providers\EventServiceProvider::class,
////        LaravelFly\Map\Illuminate\Auth\AuthServiceProvider::class ,
//        Illuminate\Broadcasting\BroadcastServiceProvider::class,
//        Illuminate\Bus\BusServiceProvider::class,
////        Illuminate\Cache\CacheServiceProvider::class ,
////        LaravelFly\Map\Illuminate\Cookie\CookieServiceProvider::class ,
//        LaravelFly\Map\Illuminate\Database\DatabaseServiceProvider::class,
////        Illuminate\Encryption\EncryptionServiceProvider::class ,
////        Illuminate\Filesystem\FilesystemServiceProvider::class ,
//        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
//        Illuminate\Hashing\HashServiceProvider::class,
//        Illuminate\Mail\MailServiceProvider::class,
//        Illuminate\Notifications\NotificationServiceProvider::class,
//        Illuminate\Pagination\PaginationServiceProvider::class,
//        Illuminate\Pipeline\PipelineServiceProvider::class,
//        Illuminate\Queue\QueueServiceProvider::class,
//        Illuminate\Redis\RedisServiceProvider::class,
//        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
////        LaravelFly\Map\Illuminate\Session\SessionServiceProvider::class ,
//        Illuminate\Translation\TranslationServiceProvider::class,
//        Illuminate\Validation\ValidationServiceProvider::class,
////        \LaravelFly\Map\Illuminate\View\ViewServiceProvider::class ,
//        App\Providers\AppServiceProvider::class,
////        App\Providers\AppWorker_ServiceProvider::class ,

        ],

        !!LARAVELFLY_SERVICES['broadcast'] ? [] : [
            Illuminate\Broadcasting\BroadcastServiceProvider::class,
            Illuminate\Broadcasting\BroadcastManager::class,
            Illuminate\Contracts\Broadcasting\Broadcaster::class,
            App\Providers\BroadcastServiceProvider::class
        ]
    ),

    /**
     * Providers to reg and boot in each request.
     *
     * There providers will be removed from app('config')['app.providers'] on worker, before any requests
     */
    'providers_in_request' => [

    ],


    /**
     * providers to reg and boot on worker, before any request. only for Mode Map
     *
     * format:
     *      proverder_name => [],
     *
     * you can also supply singleton services to made on worker
     * only singleton services are useful and valid here.
     * and the singleton services must not be changed during any request,
     * otherwise they should be made in request, no on worker.
     *
     * a singleton service is like this:
     *     *   $this->app->singleton('hash', function ($app) { ... });
     *
     * formats:
     *      proverder,                   // this provider will be booted on worker
     *      proverder2=> true,           // this provider will be booted on worker
     *      proverder1=> [],             // this provider will be booted on worker
     *      proverder3=> [
     *        '_replaced_by' => 'provider1',       // the provider1 will replace provider3 and provider3 will be deleted from app['config']['app.providers']
     *
     *        'singleton_service_1',          //  services will be made on worker
     *
     *        'singleton_service_2' => true,  //  service will be made on worker
     *
     *        'singleton_service_3' => false, //  service will not be made on worker,
     *      ],
     *
     *      proverder4=> false,           // this provider will not be booted on worker
     *      proverder5=> null,           // this provider will not be booted on worker too.
     *      proverder6=> 'across',           // this provider will not be booted on worker too.
     *      proverder7=> 'request',           // just like config('laravelfly.providers_in_request')
     *      proverder8=> 'ignore',           // just like config('laravelfly.providers_ignore')
     */
    'providers_on_worker' => [


        // this is not in config('app.providers') and registered in Application:;registerBaseServiceProviders
        Illuminate\Log\LogServiceProvider::class => [
            'log' => true,
        ],

        // this is not in config('app.providers') and registered in Application:;registerBaseServiceProviders
        Illuminate\Routing\RoutingServiceProvider::class => [
            'router' => true,
            'url' => 'clone',
            // todo
            'redirect' => false,
        ],

        Illuminate\Auth\AuthServiceProvider::class => [
            '_replaced_by' => LaravelFly\Map\Illuminate\Auth\AuthServiceProvider::class,
            'auth',
            GateContract::class,
        ],

        Illuminate\Broadcasting\BroadcastServiceProvider::class =>
            !!LARAVELFLY_SERVICES['broadcast'] ? [
                Illuminate\Broadcasting\BroadcastManager::class,
                Illuminate\Contracts\Broadcasting\Broadcaster::class,
            ] : 'ignore',

        Illuminate\Bus\BusServiceProvider::class => [],

        Illuminate\Cache\CacheServiceProvider::class => [
            'cache' => true,
            'cache.store' => true,

            /* depends */
            // if memcached is used, enable it
            // 'memcached.connector' => true,

        ],

        Illuminate\Cookie\CookieServiceProvider::class => [
            '_replaced_by' => LaravelFly\Map\Illuminate\Cookie\CookieServiceProvider::class,
            'cookie'
        ],

        Illuminate\Database\DatabaseServiceProvider::class => [
            '_replaced_by' =>
                LARAVELFLY_COROUTINE ? LaravelFly\Map\Illuminate\Database\DatabaseServiceProvider::class : false,
            'db.factory',
            'db'
        ],

        Illuminate\Encryption\EncryptionServiceProvider::class => [
            'encrypter' => true,
        ],

        Illuminate\Filesystem\FilesystemServiceProvider::class => [
            'files' => true,
            'filesystem.disk' => true,
            'filesystem.cloud' => !!LARAVELFLY_SERVICES['filesystem.cloud'],
        ],

        /* This reg FormRequestServiceProvider, whose boot is related to request */
        Illuminate\Foundation\Providers\FoundationServiceProvider::class => 'across',

        Illuminate\Hashing\HashServiceProvider::class => [

            // 'hash' => !empty(LARAVELFLY_SERVICES['hash']) ? true : 'clone',
            'hash' => true, // no need to clone it when empty(LARAVELFLY_SERVICES['hash'], as changed props not belongs to 'hash', but to drivers

            'hash.driver',
        ],

        Illuminate\Mail\MailServiceProvider::class => [],

        Illuminate\Notifications\NotificationServiceProvider::class => 'across',

        /**
         * some static props like currentPathResolver, ... in Illuminate\Pagination\AbstractPaginator
         * in most cases they keep same.
         * if not same, `use StaticDict` is needed to convert AbstractPaginator in Map Mode.
         */
        Illuminate\Pagination\PaginationServiceProvider::class => [],

        Illuminate\Pipeline\PipelineServiceProvider::class => [],

        Illuminate\Queue\QueueServiceProvider::class => [],

        Illuminate\Redis\RedisServiceProvider::class => [
            'redis' => !!LARAVELFLY_SERVICES['redis'],
        ],

        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class => [],

        Illuminate\Session\SessionServiceProvider::class => [
            '_replaced_by' => LaravelFly\Map\Illuminate\Session\SessionServiceProvider::class,
            'session',
            'session.store',
            \Illuminate\Session\Middleware\StartSession::class
        ],

        Illuminate\Translation\TranslationServiceProvider::class =>
            !!LARAVELFLY_SERVICES['translator'] || !!LARAVELFLY_SERVICES['validator'] ? [
                '_replaced_by' => LaravelFly\Map\Illuminate\Translation\TranslationServiceProvider::class,
                'translation.loader' => true,
                'translator' => true,
            ] : 'ignore',

        Illuminate\Validation\ValidationServiceProvider::class =>
            !!LARAVELFLY_SERVICES['validator'] ? [
                'validator' => true,
                'validation.presence' => true,
            ] : 'ignore',

        Illuminate\View\ViewServiceProvider::class => [
            '_replaced_by' => \LaravelFly\Map\Illuminate\View\ViewServiceProvider::class,
            'view', 'view.engine.resolver', 'blade.compiler'
        ],


        /*
         * Application Service Providers...
         */


        /* depends */
        /**
         * if it's register and boot need executing in each request, set to 'request' or move it to 'providers_in_request'
         * if it's boot can execute on worker (before any requests), set to true or [].
         */
        App\Providers\AppServiceProvider::class => 'across',

        /* depends */
        /**
         * if some executions always same in each request,
         * suggest to create a new AppServiceProvider whoes reg and boot are both executed on worker.
         */
        App\Providers\AppWorker_ServiceProvider::class => [],

        /* depends */
        /**
         * its boot relates Illuminate\Auth\Access\Gate
         * which would better not to be made on worker
         * because it has props like afterCallbacks relating memory leak
         */
        App\Providers\AuthServiceProvider::class => 'across',

        App\Providers\BroadcastServiceProvider::class => !!LARAVELFLY_SERVICES['broadcast'] ? [] : 'ignore',

        /* depends */
        /**
         * if it's register and boot need executing in each request, set to 'request' or move it to 'providers_in_request'
         * if it's events are always same in different request, set to true or [].
         */
        App\Providers\EventServiceProvider::class => [],

        /* depends */
        App\Providers\RouteServiceProvider::class => [],
//        App\Providers\RouteServiceProvider::class => 'across',

        /*
         * Third Party
         */

        // Collision is an error handler framework for console/command-line PHP applications such as laravelfly
        NunoMaduro\Collision\Adapters\Laravel\CollisionServiceProvider::class => [
            Illuminate\Contracts\Debug\ExceptionHandler::class => true,
        ],

        Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider::class => [
            Mcamara\LaravelLocalization\LaravelLocalization::class => 'clone',
        ],

        /*
         * LaravelFly
         *
         * /laravel-fly/info
         */

        LaravelFly\Providers\RouteServiceProvider::class => [],
    ],


    'services_on_worker' => [
        '_fake_name' => [
            'on_worker' => false,

            'init_on_work' => function () {
            },
            'clean_Facade_on_work' => false,
            'clone' => false,
            'update_on_request' => function () {
            },
        ],
    ],


    /**
     * if a Facade alias of a CLONE SERVICE maybe used before any requests, put it here to clean.
     *
     * No worry about the Facade alias used in a request, because refactor working has done on Facade.
     */
    'clean_Facade_on_work' => [

        // a facke request instance made on work
        'request',
        //'url' has been made on work? when? \Illuminate\Routing\RoutingServiceProvider
        'url',

        'laravellocalization',

    ],

    /**
     * for Mode Map
     */
    'update_on_request' => [

        [
            'this' => 'laravellocalization',
            'closure' => function () {
                $this->url = app('url');
                app()->rebinding('request', function () {
                    $this->request = app('request');
                });
            }
        ],

        // for hash
        !empty(LARAVELFLY_SERVICES['hash']) ? false :
            [
                'this' => 'hash',
                'closure' => function () {
                    // $this here is app('hash'), the instance of HashManager
                    // by default, $name is bcrypt and argon
                    foreach ($this->getDrivers() as $name => $drive) {
                        $this->drivers[$name] = clone $drive;
                        // debug_zval_dump($this->drivers[$name] );
                    }
                },
            ],


        // put one more updating item here
        [
            // 'this' => 'name',
            // 'closure' => function () { },
        ]
    ],

    'singleton_route_middlewares' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class, // hacked by LaravelFly\Map\Illuminate\Session\StartSession
        //todo
//        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,

        //todo
//        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        //todo
//        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        //todo
//        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        //todo
//        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ],

    // only helpful when LARAVELFLY_SERVICES['kernel']===true
    'singleton_middlewares' => [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ],


];

