@extends('layout.master')
@section('title', 'Edit Transaksi')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Transaksi</h2>

        <!-- PERBAIKAN 1: Action URL harus mengarah ke /transaksi/{id} sesuai web.php -->
        <form action="{{ url('/transaksi/' . $data->id) }}" method="POST">
            @csrf

            <!-- PERBAIKAN 2: Tambahkan @method('PUT') karena route di web.php menggunakan Route::put -->
            @method('PUT')

            <!-- PENTING: ID Transaksi disembunyikan (masih berguna untuk validasi request->id di controller) -->
            <input type="hidden" name="id" value="{{ $data->id }}">

            <div class="space-y-5">
                <!-- Input Keterangan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Transaksi</label>
                    <input type="text" name="keterangan" value="{{ $data->keterangan }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border" required>
                </div>

                <!-- Input Nominal & Tanggal -->
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                        <input type="number" name="nominal" value="{{ $data->nominal }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $data->tanggal }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border" required>
                    </div>
                </div>

                <!-- Input Jenis Transaksi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Transaksi</label>
                    <div class="flex space-x-4">
                        <!-- Pilihan Pemasukan -->
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 w-full">
                            <input type="radio" name="jenis" value="pemasukan" {{ $data->jenis == 'pemasukan' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">Pemasukan</span>
                        </label>

                        <!-- Pilihan Pengeluaran -->
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 w-full">
                            <input type="radio" name="jenis" value="pengeluaran" {{ $data->jenis == 'pengeluaran' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">Pengeluaran</span>
                        </label>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection