<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\CekTipeUser;

// 1. Rute Dashboard (Read)
Route::get('/', [TransaksiController::class, 'index']);

// 2. Rute Form Tambah Data (Create - View)
Route::get('/transaksi/create', [TransaksiController::class, 'create']);

// 3. Rute Simpan Data (Create - Logic)
Route::post('/transaksi', [TransaksiController::class, 'store']);

// 4. Rute dengan Middleware (Proteksi)
Route::get('/laporan', function () {
    return "<h1>Halaman Laporan VIP</h1><p>Selamat datang, user VIP!</p>";
})->middleware(CekTipeUser::class);

// --- BAGIAN EDIT & UPDATE ---

// [PERBAIKAN] Membuka halaman edit HARUS pakai GET (Bukan PUT)
Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'edit']);

// Proses Simpan Perubahan pakai PUT (Sesuai form @method('PUT'))
Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);

// --- BAGIAN HAPUS (DELETE) ---
// Ini route tambahan agar tombol hapus bisa berfungsi
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);
