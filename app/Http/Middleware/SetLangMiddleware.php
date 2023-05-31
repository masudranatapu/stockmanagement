<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(session()->get('set_lang'));

        if (session()->has('set_lang')) {
            app()->setLocale(session('set_lang'));
        } else {
            app()->setLocale(env('APP_DEFAULT_LANGUAGE'));
        }

        return $next($request);
    }
}
