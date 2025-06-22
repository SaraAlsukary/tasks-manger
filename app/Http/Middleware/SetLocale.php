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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
            if ($request->has('lang')) {
                 $lang = $request->query('lang');
            if (in_array($lang, ['en', 'ar'])) {
                 app()->setLocale($lang);
                 session()->put('locale', $lang);
            }
            } elseif (session()->has('locale')) {
                 app()->setLocale(session()->get('locale'));
            }

            return $next($request);
    }
}