<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->cookie('app_locale')
            ?? config('app.locale');

        App::setLocale($locale);

        \Log::debug('Get locale: ' . App::getLocale());

        return $next($request);
    }
}
