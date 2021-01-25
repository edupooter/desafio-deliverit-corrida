<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (request('change_language')) {
            session()->put('language', request('change_language'));
            $language = request('change_language');
        } elseif (session('language')) {
            $language = session('language');
        } elseif ('pt-br') {
            $language = 'pt-br';
        }

        if (isset($language)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
