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
    protected $description = 'generate columns.php and headers.php located ./staticizer/';

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
        ( new \App\Services\Staticizer)->useColumnsData('_makeColumnsCache');
    }
}
