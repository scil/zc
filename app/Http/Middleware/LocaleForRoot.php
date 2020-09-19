<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\LanguageNegotiator;

class LocaleForRoot
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
        // 初次访问首页，需要判断是否自动转移到其它页面
        if (!$request->hasPreviousSession()) {

            $locale = (new LanguageNegotiator("en", LaravelLocalization::getSupportedLocales(), $request))->negotiateLanguage();

            \Log::debug("first $locale");
            if ($locale !== DEFAULT_LOCAL)
                return new RedirectResponse("/$locale", 302, ['Vary' => 'Accept-Language']);
        }

        \Log::debug("no first");
        app()->setLocale(DEFAULT_LOCAL);
        \View::share('LOCALE', DEFAULT_LOCAL);
        return $next($request);


    }
}
