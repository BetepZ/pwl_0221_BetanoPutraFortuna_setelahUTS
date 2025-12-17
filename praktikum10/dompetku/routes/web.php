<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;     // Jangan lupa import AuthController
use App\Http\Middleware\CekLogin;            // Import Middleware Baru
use App\Http\Middleware\CekTipeUser;

// --- ROUTE PUBLIC (BISA DIAKSES SIAPA SAJA) ---
// Halaman Login
Route::get('/login', [AuthController::class, 'showLoginForm']);
// Proses Login
Route::post('/login', [AuthController::class, 'login']);
// Proses Logout
Route::get('/logout', [AuthController::class, 'logout']);


// --- ROUTE PROTECTED (HARUS LOGIN DULU) ---
// Kita bungkus semua route dashboard & transaksi dalam middleware 'CekLogin'
Route::middleware([CekLogin::class])->group(function () {

    // 1. Dashboard
    Route::get('/', [TransaksiController::class, 'index']);
    Route::get('/transaksi', [TransaksiController::class, 'index']);

    // 2. Transaksi (Create, Store, Edit, Update, Delete)
    Route::get('/transaksi/create', [TransaksiController::class, 'create']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'edit']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);

    // 3. Laporan VIP (Proteksi Ganda: Harus Login + Harus VIP)
    Route::get('/laporan', [\App\Http\Controllers\TransaksiController::class, 'laporan'])
        ->middleware(\App\Http\Middleware\CekTipeUser::class);
});
