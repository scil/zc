<?php

if (!defined('LARAVELFLY_MODE')) define('LARAVELFLY_MODE',
//    'Map'
'Simple'
);

if (!defined('HONEST_IN_CONSOLE')) define('HONEST_IN_CONSOLE',
    false
);

if (!defined('LARAVELFLY_SERVICES')) define('LARAVELFLY_SERVICES', [

    /**
     * make the corresponding service to be true if you use it.
     */
    "redis" => false,
    'filesystem.cloud' => false,
    'broadcast' => false,

    'hash' => true,

    'view.finder' => true,

    'config' => true,
    'kernel' => true,
]);


return [
    'server' => \LaravelFly\Server\HttpServer::class,

    'tinker' => true,
    'dispatch_by_query' => false,

    'listen_ip' => '0.0.0.0',// listen to any address
    //'listen_ip' => '127.0.0.1',// listen only to localhost

    'listen_port' => 9501,

    'worker_num' => 1,
    'max_request' => 1000,

    'max_coro_num' => 3000,

    'daemonize' => true,
//    'daemonize' => false,

    'watch' => [
        '/home/vagrant/.fly-watch',
    ],
    'watch_delay' => 3500,

    'pre_include' =>'true',

    'pre_files' => [
    ],

//    'early_laravel' => true,
    'early_laravel' => false,

//    'user' => 'www-data', 'group' => 'www-data',

    'log_file' => __DIR__ . '/storage/logs/swoole.log',

    'log_cache' => 3,

    'kernel' => \App\Http\Kernel::class,

];
