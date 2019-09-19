<?php
$basePath = $basePath ?? __DIR__;

if (!defined('HOMEPAGE_PLOTS_QUOTE'))
    require $basePath . '/bootstrap/app-before.php';

foreach (file($basePath . '/.env') as $line) {
    if (substr($line, 0, 7) === 'APP_ENV') {
        $IN_PRODUCTION = trim($line) !== 'APP_ENV=local';
        break;
    }
}
if (!isset($IN_PRODUCTION)) die('no .env found in ' . $basePath);


//const LARAVELFLY_MODE = 'Backup';
//const LARAVELFLY_MODE = 'FpmLike';
const LARAVELFLY_MODE = 'Map';

const LARAVELFLY_COROUTINE = true;

const HONEST_IN_CONSOLE = false;

const LARAVELFLY_SERVICES = [

    "redis" => 'use',
    'filesystem.cloud' => !'use',
    'broadcast' => !'use',
    'translator' => 'use',
    'validator' => 'use',

    'routes' => true,
    'cookie' => true,
    'auth' => true,
    'bus' => true,
    'hash' => true,
    'view.finder' => true,

    'kernel' => true,

    'no_contextual_binding_for_worker_services' => true,
];


return [
    'server' => \LaravelFly\Server\HttpServer::class,

    'tinker' => !$IN_PRODUCTION,
    'echo_level' => $IN_PRODUCTION ? 1 : 3,
    'dispatch_by_query' => false,

    'listen_ip' => $IN_PRODUCTION ? '127.0.0.1' : '0.0.0.0',

    'listen_port' => 9501,

    'worker_num' => $IN_PRODUCTION ? 4 : 1,
    'task_worker_num' => 0,//$IN_PRODUCTION ? 10 : 1,
    'max_coro_num' => 20,
    'max_conn' => 1024,
    'max_request' => 2000,

    // 'daemonize' => true,
    'daemonize' => false,

    'watch' => [
        //'/home/vagrant/.fly-watch',
        __DIR__ . '/app',
    ],
    'watch_delay' => 3500,
    'watch_down' => false,

    'pre_include' => $IN_PRODUCTION,

    'pre_files' => [
    ],

    // 'early_laravel' => true,
    'early_laravel' => false,

    'swoole_session_back' => '',
//    'swoole_session_back' => 'redis',

    'prestart_func' => function () {

        /**
         * @var LaravelFly\Server\Common $this
         */
        // $this->newIntegerMemory('hits', new swoole_atomic(0));

        if ($this->getConfig('swoole_session_back')) {
            $this->newTableMemory(
                'swooleSession',
                32768,  // 32768 means it store max 32768 sessions
                [
                    // 'user_id' => [ swoole_table::TYPE_INT,  4],
                    'payload' => [swoole_table::TYPE_STRING, 1000], // 1000 bytes is appropriate for most cases
                    'last_activity' => [swoole_table::TYPE_INT, 4], // 4 bytes
                ],
                \LaravelFly\Tools\SessionTable::class
            );

        }


        // event
        // $this->getDispatcher()->addListener('worker.starting', function (GenericEvent $event) {
        //    echo "There files can not be hot reloaded, because they are included before worker starting\n";
        //    var_dump(get_included_files());
        // });

    },

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
    'application' => '\LaravelFly\\' . LARAVELFLY_MODE . '\Application',

];
