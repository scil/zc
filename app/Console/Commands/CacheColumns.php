<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CacheColumns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'column:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate view files and ./staticizer/columns.php about column data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ( new \App\Http\Controllers\Staticizer)->createColumnsData();
    }
}
