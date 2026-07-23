<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('lang') && in_array($request->query('lang'), ['en', 'ar', 'so'])) {
            app()->setLocale($request->query('lang'));
        } elseif (session()->has('locale')) {
            app()->setLocale(session('locale'));
        } else {
            app()->setLocale(config('app.locale', 'en'));
        }

        return $next($request);
    }
}
