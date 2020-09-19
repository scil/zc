<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BladeColumns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'column:blade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate view files';

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
//        ( new \App\Services\Staticizer)->makeColumnsCacheAndBlade();
        ( new \App\Services\Staticizer)->makeColumnsBlade();

        return 0;
    }
}
