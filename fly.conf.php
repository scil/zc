<?php

$basePath = $basePath ?? __DIR__;

foreach (file($basePath . '/.env') as $line) {
    if (substr($line, 0, 7) === 'APP_ENV') {
        $IN_PRODUCTION = trim($line) !== 'APP_ENV=local';
        break;
    }
}
if (!isset($IN_PRODUCTION)) die('no .env found in ' . $basePath);


//const LARAVELFLY_MODE = 'Backup';
const LARAVELFLY_MODE = 'Map';

const HONEST_IN_CONSOLE = false;

const LARAVELFLY_SERVICES = [

    "redis" => true,
    'filesystem.cloud' => false,
    'broadcast' => false,

    'routes' => true,
    'cookie' => true,
    'auth' => true,
    'hash' => true,
    'view.finder' => true,

    'config' => true,
    'kernel' => true,

];


return [
    'server' => \LaravelFly\Server\HttpServer::class,

    'tinker' => !$IN_PRODUCTION,
    'echo_level' => $IN_PRODUCTION ? 1 : 3,
    'dispatch_by_query' => false,

    'listen_ip' => $IN_PRODUCTION ? '127.0.0.1' : '0.0.0.0',

    'listen_port' => 9501,

    'worker_num' => $IN_PRODUCTION ? 5 : 1,
    'max_coro_num' => 20,
    'max_conn' => 128,
    'max_request' => 500,

    // 'daemonize' => true,
    'daemonize' => false,

    'watch' => [
        //'/home/vagrant/.fly-watch',
    ],
    'watch_delay' => 3500,
    'watch_down' => false,

    'pre_include' => $IN_PRODUCTION,

    'pre_files' => [
    ],

    // 'early_laravel' => true,
    'early_laravel' => false,

    // 'user' => 'www-data', 'group' => 'www-data',

    /**
     * By default the max size of POST data/file is 10 MB which is restricted by package_max_length.
     *
     * swoole will joint the data received from the client amd store the data in memory before recevicing the whole package.
     * So to limit the usage of memory, decrease it.
     */
    // 'package_max_length' => 10 * 1024 * 1024, // byte in unit

    'log_file' => __DIR__ . '/storage/logs/swoole.log',

    'log_cache' => 5,

    'kernel' => \App\Http\Kernel::class,

];
