<?php
/**
 * User: scil
 * Date: 2018/9/12
 * Time: 0:04
 */

namespace App\Http\Middleware;

use Closure;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locle = LaravelLocalization::setLocale();

        var_dump($locle);

        return $next($request);

    }

}