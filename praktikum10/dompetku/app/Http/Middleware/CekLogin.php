<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class cekLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Simulasi Login Sederhana
        // Kita cek apakah di URL ada parameter ?user=admin
        // Contoh akses sukses: http://localhost:8000/transaksi/create?user=admin

        if ($request->query('user') !== 'admin') {
            // Jika bukan admin, tendang balik ke halaman dashboard dengan pesan error
            return redirect('/')->with('error', 'Maaf, Anda belum login sebagai Admin!');
        }

        return $next($request);
    }
}
