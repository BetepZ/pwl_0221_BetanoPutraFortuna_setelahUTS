<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('is_logged_in')) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu!');
        }
        return $next($request);
    }
}
