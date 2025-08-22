<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next)
{
    if (session()->has('locale')) {
        $locale = session()->get('locale');
        App::setLocale($locale);
        
        // Add debug output
        \Log::info("Locale set to: " . $locale);
        \Log::info("Current locale: " . App::getLocale());
    } else {
        \Log::info("No locale in session, using default: " . App::getLocale());
    }

    return $next($request);
}
}
