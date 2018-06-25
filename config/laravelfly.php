<?php

if (!defined('LARAVELFLY_MODE')) return [];

return [

    'view_compile_1' => LARAVELFLY_SERVICES['view.finder'] &&
        (env('APP_ENV') === 'production' || env('APP_ENV') === 'product'),

    /**
     * useless providers. Not For Mode FpmLike
     *
     * There providers will be removed from app('config')['app.providers'] on worker, before any requets
     */
    'providers_ignore' => array_merge([
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Laravel\Tinker\TinkerServiceProvider::class,
        Fideloper\Proxy\TrustedProxyServiceProvider::class,
        LaravelFly\Providers\CommandsServiceProvider::class,
        'Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider',
//        'Barryvdh\\Debugbar\\ServiceProvider',

    ], LARAVELFLY_SERVICES['broadcast'] ? [] : [
        Illuminate\Broadcasting\BroadcastManager::class,
        Illuminate\Contracts\Broadcasting\Broadcaster::class,
        App\Providers\BroadcastServiceProvider::class
    ]),

    /**
     * Providers to reg and boot in each request. Not For Mode FpmLike
     *
     * There providers will be removed from app('config')['app.providers'] on worker, before any requets
     */
    'providers_in_request' => [
    ],

    /**
     * providers to reg and boot on worker, before any request. only for Map mode
     *
     * format:
     *      proverder_name => [],
     *
     * you can also supply singleton services to made on worker
     * only singleton services are useful and valid here.
     * and the singleton services must not be changed during any request,
     * otherwise they should be made in request, no on worker.
     *
     * a singeton service is like this:
     *     *   $this->app->singleton('hash', function ($app) { ... });
     *
     * formats:
     *      proverder2=> [
     *        '_replace' => 'provider1', // the provider1 will be replaced by provider2 and deleted from app['config']['app.providers']
     *        'singleton_service_1' => true,  //  service will be made on worker
     *        'singleton_service_2' => false, //  service will not be made on worker,
     *                                            even if the service has apply if using coroutineFriendlyServices()
     *      ],
     *      proverder3=> true,           // this provider will be booted on worker
     *      proverder4=> false,           // this provider will not be booted on worker
     *      proverder5=> null,           // this provider will not be booted on worker too.
     */
    'providers_on_worker' => [
        // this is not in config('app.providers') and has once registered in Application:;registerBaseServiceProviders
        Illuminate\Log\LogServiceProvider::class => [
            'log' => true,
        ],
        LaravelFly\Map\Illuminate\Auth\AuthServiceProvider::class => [
            '_replace' => Illuminate\Auth\AuthServiceProvider::class,
        ],
        Illuminate\Broadcasting\BroadcastServiceProvider::class =>
            LARAVELFLY_SERVICES['broadcast'] ? [
                Illuminate\Broadcasting\BroadcastManager::class,
                Illuminate\Contracts\Broadcasting\Broadcaster::class,
            ] : false,
        Illuminate\Bus\BusServiceProvider::class => [],
        Illuminate\Cache\CacheServiceProvider::class => [
            'cache' => true,
            'cache.store' => true,
            /* depends */
            // if memcached is used, enable it
            // 'memcached.connector' => true,

        ],
        LaravelFly\Map\Illuminate\Cookie\CookieServiceProvider::class => [
            '_replace' => Illuminate\Cookie\CookieServiceProvider::class,
        ],
        LaravelFly\Map\Illuminate\Database\DatabaseServiceProvider::class => [
            '_replace' => Illuminate\Database\DatabaseServiceProvider::class,
        ],
        Illuminate\Encryption\EncryptionServiceProvider::class => [
            'encrypter' => true,
        ],
        Illuminate\Filesystem\FilesystemServiceProvider::class => [
            'files' => true,
            'filesystem.disk' => true,
            'filesystem.cloud' => LARAVELFLY_SERVICES['filesystem.cloud'],
        ],
        /* This reg FormRequestServiceProvider, whose boot is related to request */
        // Illuminate\Foundation\Providers\FoundationServiceProvider::class=>[] : providers_across ,
        Illuminate\Hashing\HashServiceProvider::class => [
            'hash' => LARAVELFLY_SERVICES['hash']
        ],
        Illuminate\Mail\MailServiceProvider::class => [],

        // Illuminate\Notifications\NotificationServiceProvider::class,

        Illuminate\Pagination\PaginationServiceProvider::class => [],

        Illuminate\Pipeline\PipelineServiceProvider::class => [],
        Illuminate\Queue\QueueServiceProvider::class => [],
        Illuminate\Redis\RedisServiceProvider::class => [
            'redis' => LARAVELFLY_SERVICES['redis'],
        ],
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class => [],
        LaravelFly\Map\Illuminate\Session\SessionServiceProvider::class => [
            '_replace' => Illuminate\Session\SessionServiceProvider::class,
        ],
        Illuminate\Translation\TranslationServiceProvider::class => [
            'translation.loader' => true,
            'translator' => true,
        ],
        Illuminate\Validation\ValidationServiceProvider::class => [
            'validator' => true,
            'validation.presence' => true,
        ],
        \LaravelFly\Map\Illuminate\View\ViewServiceProvider::class => [
            '_replace' => Illuminate\View\ViewServiceProvider::class,
        ],
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class => false,

        App\Providers\WorkerAppServiceProvider::class => [],

        //todo
        App\Providers\AuthServiceProvider::class => [],
        App\Providers\BroadcastServiceProvider::class => LARAVELFLY_SERVICES['broadcast'] ? [] : false,
        App\Providers\EventServiceProvider::class => [],
        App\Providers\RouteServiceProvider::class => [],

        // Collision is an error handler framework for console/command-line PHP applications such as laravelfly
        NunoMaduro\Collision\Adapters\Laravel\CollisionServiceProvider::class => [
            Illuminate\Contracts\Debug\ExceptionHandler::class => true,
        ],
    ],

    /**
     * Which properties of base services need to backup. Only for Mode Simple
     *
     * See: Illuminate\Foundation\Application::registerBaseServiceProviders
     */
    'BaseServices' => [

        \Illuminate\Contracts\Http\Kernel::class => [
            /** depends
             * put new not safe properties here
             */
             // 'newProp1', 'newProp2',

            /** depends
             * Uncomment it if it's not always same across multiple request. They may be changed by Route::middleware
             * No need worry about same middlewares are added multiple times,
             * because there's a check in Illuminate\Foundation\Http::pushMiddleware or prependMiddleware:
             *          if (array_search($middleware, $this->middleware) === false)
             */
              // 'middleware',
        ],

        /* Illuminate\Events\EventServiceProvider::class : */
        'events' => [
            'listeners', 'wildcards', 'queueResolver',
        ],

        /* Illuminate\Routing\RoutingServiceProvider::class : */
        'router' => [
            /** depends
             * Uncomment them if it's not same on each requests. They may be changed by Route::middleware
             */
            // 'middleware','middlewareGroups','middlewarePriority',

            /** not necessary to backup,
             * it will be changed during next request
             * // 'current',
             */

            /** not necessary to backup,
             * the ref to app('request') will be released during next request
             * //'currentRequest',
             */

            'obj.routes' => [
                /** depends
                 *
                 * Uncomment them if some of your routes are created during any request.
                 * Besides, because values of these four properties are associate arrays,
                 * if names of routes created during request are sometime different , please uncomment them ,
                 */
                // 'routes' , 'allRoutes' , 'nameList' , 'actionList' ,
            ],
        ], /* end 'router' */

        'url' => [
            /* depends */
            // 'forcedRoot', 'forceSchema',
            // 'cachedRoot', 'cachedSchema',

            /** not necessary to backup,
             *
             * the ref to app('request') will be released during next request;
             * and no need set request for `url' on every request , because there is a $app->rebinding for request:
             *      $app->rebinding( 'request', $this->requestRebinder() )
             * //'request'
             */
        ],


        /** nothing need to backup
         *
         * // 'redirect' => false,
         * // 'routes' => false,
         * // 'log' => false,
         */
    ],
];

