<?php
use Closure;

class Memory
{
    public function handle($request, Closure $next)
    {
        $TARGET = 14;
        $USE_PROF = false;
        $USE_LOG = false;

        static $before = 0, $after = 0, $time = 0;
        $time++;

        if ($USE_PROF && ($time == $TARGET)) memprof_enable();

        if ($USE_LOG) {

            $dif = memory_get_usage() - $before;
            $before = memory_get_usage();
            \Log::info("memory before +: $dif; $before ");
        }

        $response = $next($request);

        if ($USE_LOG) {
            $dif = memory_get_usage() - $after;
            $after = memory_get_usage();
            \Log::info("memory after  +: $dif; $after ");
        }

        if ($USE_PROF && ($time == $TARGET )) {
            $dump = memprof_dump_array();
            ob_start();
            print_r($dump);
            $d = ob_get_clean();
            file_put_contents("/vagrant/callgrind.middleware+1.$time.out", $d);
        }

        return $response;

    }

}