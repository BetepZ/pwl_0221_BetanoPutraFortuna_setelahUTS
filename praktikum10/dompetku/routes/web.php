<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;     // Import Controller Auth
use App\Http\Middleware\CekLogin;            // Import Middleware Login
use App\Http\Middleware\CekTipeUser;         // Import Middleware VIP

// --- 1. ROUTE PUBLIC (BISA DIAKSES SIAPA SAJA) ---

// Menampilkan Halaman Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Memproses Login (POST)
Route::post('/login', [AuthController::class, 'login']);

// Memproses Logout
Route::get('/logout', [AuthController::class, 'logout']);


// --- 2. ROUTE PROTECTED (HARUS LOGIN DULU) ---
// Semua route di dalam grup ini dijaga oleh Middleware 'CekLogin'
Route::middleware([CekLogin::class])->group(function () {

    // Dashboard Utama
    Route::get('/', [TransaksiController::class, 'index']);
    Route::get('/transaksi', [TransaksiController::class, 'index']);

    // Fitur Transaksi (CRUD)
    Route::get('/transaksi/create', [TransaksiController::class, 'create']);       // Form Tambah
    Route::post('/transaksi', [TransaksiController::class, 'store']);              // Simpan Baru
    Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'edit']);      // Form Edit
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);         // Simpan Edit
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);     // Hapus Data

    // Halaman Laporan VIP (Proteksi Ganda: Harus Login + Harus VIP)
    // Route ini memanggil function 'laporan' di TransaksiController
    Route::get('/laporan', [\App\Http\Controllers\TransaksiController::class, 'laporan'])
        ->middleware(\App\Http\Middleware\CekTipeUser::class);
});
