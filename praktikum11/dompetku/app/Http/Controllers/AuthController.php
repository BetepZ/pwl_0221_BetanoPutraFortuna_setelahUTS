<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function showLoginForm()
    {
        return view('login');
    }

    // Memproses Login (Hardcode)
    public function login(Request $request)
    {
        // Ambil input email & password
        $email = $request->input('email');
        $password = $request->input('password');

        // Cek manual (Hardcode sesuai soal)
        if ($email == 'admin@dompetku.com' && $password == 'admin') {

            // Jika cocok, simpan sesi 'is_logged_in' = true
            session(['is_logged_in' => true]);

            // Alihkan ke Dashboard
            return redirect('/')->with('success', 'Berhasil Login! Selamat Datang Admin.');
        }

        // Jika salah, kembali ke login dengan pesan error
        return redirect('/login')->with('error', 'Email atau Password salah!');
    }

    // Logout (Opsional tapi penting)
    public function logout()
    {
        session()->forget('is_logged_in');
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
