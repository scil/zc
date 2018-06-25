<?php

namespace App\Http\Middleware;

use Closure;

class Http2Push
{
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

        $push = app('http2push');
        if (!$request->ajax()) {
            if ($push->hasLinks()) {
                list($links, $C) = $push->generateLinksCookies();
                if ($links) {
                    $response->headers->set('Link', implode(',', $links), false);
                }
                $response->cookie($C);

            }
        }
        return $response;

    }
}
