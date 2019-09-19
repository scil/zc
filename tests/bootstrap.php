<?php

namespace Tests;
use Illuminate\Contracts\Console\Kernel;
use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\BeforeFirstTestHook;
class Bootstrap implements BeforeFirstTestHook, AfterLastTestHook
{
    /*
    |--------------------------------------------------------------------------
    | Bootstrap The Test Environment
    |--------------------------------------------------------------------------
    |
    | You may specify console commands that execute once before your test is
    | run. You are free to add your own additional commands or logic into
    | this file as needed in order to help your test suite run quicker.
    |
    */
    use CreatesApplication;
    public function executeBeforeFirstTest(): void
    {
    
        $loader = require __DIR__ . '/../vendor/autoload.php';

        require_once __DIR__.'/../vendor/scil/laravel-fly-local/tests/swoole_src_tests/include/swoole.inc';
        require_once __DIR__.'/../vendor/scil/laravel-fly-local/tests/swoole_src_tests/include/lib/curl_concurrency.php';

    
    
        $console = $this->createApplication()->make(Kernel::class);

        $commands = [
            'config:cache',
            'event:cache',
        ];

        foreach ($commands as $command) {
            $console->call($command);
        }
    }

    public function executeAfterLastTest(): void
    {
        array_map('unlink', glob('bootstrap/cache/*.phpunit.php'));
    }
}
