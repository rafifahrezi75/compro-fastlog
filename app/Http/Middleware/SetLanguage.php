<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Jika ada parameter ?lang=id atau ?lang=en di URL, simpan ke Session
        if ($request->has('lang')) {
            $lang = $request->get('lang');
            if (in_array($lang, ['id', 'en'])) {
                Session::put('locale', $lang);
            }
        }

        // 2. Ambil bahasa dari Session (default ke 'id' jika belum ada)
        $locale = Session::get('locale', 'id');

        // 3. Terapkan bahasa ke aplikasi Laravel
        App::setLocale($locale);

        return $next($request);
    }
}