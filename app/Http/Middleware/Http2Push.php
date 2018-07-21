<?php

namespace App\Http\Middleware;

use Closure;

class Http2Push
{
    const PUSH_FLAG = 'pushflag';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // 一次session只检查一次
        if (!$request->session()->has(static::PUSH_FLAG)) {

            if (!$request->ajax()) {

                echo 'http2push-----  ';
                $push = app('http2push');

//            if ($push->hasLinks()) {

                list($links, $C) = $push->generateLinksCookies();

                $links && $response->headers->set('Link', implode(',', $links), false);

                $C && $response->cookie($C);

//            }

            }

            $request->session()->put(static::PUSH_FLAG, '1');

        }

        return $response;

    }
}
