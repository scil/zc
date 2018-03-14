<?php

/**
 * Simple, Hash, FpmLike or Greedy
 *
 * FpmLike: like php-fpm, objects are made in each request.
 * Greedy: only for study
 */
if (!defined('LARAVELFLY_MODE')) define('LARAVELFLY_MODE',
    'Map'
);

/**
 * honest that application is running in cli mode.
 *
 * Some serivces, such as DebugBar, not run in cli mode.
 * Some service providers, such as MailServiceProvider, get ready to publish  resources in cli mode.
 *
 * Set it true, Application::runningInConsole() return true, and DebugBar can not start.
 * If you use FpmLike, must keep it false.
 */
if (!defined('HONEST_IN_CONSOLE')) define('HONEST_IN_CONSOLE',
    false
);

/**
 * make some services on worker, before any requests, to save memory
 *
 * only for Mode Hash and advanced users
 *
 * A COROUTINE-FRIENDLY SERVICE must satisfy folling conditions:
 * 1. singleton. A singleton service is made by by {@link Illuminate\Containe\Application::singleton()} or {@link Illuminate\Containe\Application::instance() }
 * 2. its vars will not changed in any requests
 * 3. if it has ref attibutes, like app['events'] has an attribubte `container`, the container must be also A COROUTINE-FRIENDLY SERVICE
 */
if (!defined('LARAVELFLY_CF_SERVICES')) define('LARAVELFLY_CF_SERVICES', [

    /**
     * make the corresponding service to be true if you use it.
     */
    "redis" => false,
    'filesystem.cloud' => false,
    'broadcast' => false,

    // to false if app('hash')->setRounds may be called in a request
    'hash' => true,

    /**
     * to false if same view name refers to different view files in different requests.
     * for example:
     *      view 'home' may points to 'guest_location/home.blade.php' for a guest ,
     *      while to 'admin_location/home.blade.php' for an admin
     */
    'view.finder' => true,
]);


/**
 * this array is used for swoole server,
 * see more option list at :
 * 1. Swoole HTTP server configuration https://www.swoole.co.uk/docs/modules/swoole-http-server/configuration
 * 2. Swoole server configuration https://www.swoole.co.uk/docs/modules/swoole-server/configuration
 */
return [
    /**
     * provided by LaravelFly:
     *      \LaravelFly\Server\HttpServer::class
     *      \LaravelFly\Server\WebSocketServer::class  // still under dev
     *
     * when LARAVELFLY_MODE == 'FpmLike', this is ignored and \LaravelFly\Server\FpmHttpServer::class is used.
     */
    'server' => \LaravelFly\Server\HttpServer::class,

    /**
     * true if you use eval(tinker())
     */
//    'tinker' => true,
    'dispatch_by_query' => false,

    // 'listen_ip' => '0.0.0.0',// listen to any address
    'listen_ip' => '127.0.0.1',// listen only to localhost

    'listen_port' => 9501,

    'worker_num' => 1,

    'max_coro_num' => 3000,

   'daemonize' => true,
//    'daemonize' => false,

    'user' => 'www-data',
    'group' => 'www-data',

    'log_file' => __DIR__ . '/storage/logs/swoole.log',

    'kernel' => \App\Http\Kernel::class,

];
