<?php

namespace App\Http\Controllers;

use App\Models\Transaksi; // Pakai Model Eloquent
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini jika mau pakai DB facade, tapi kita pakai Eloquent di bawah

class TransaksiController extends Controller
{
    // Halaman Dashboard dengan Fitur Search & Pagination
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Transaksi::orderBy('tanggal', 'desc');

        if ($search) {
            $query->where('keterangan', 'like', "%{$search}%");
        }

        $dataTransaksi = $query->paginate(5);
        $dataTransaksi->appends(['search' => $search]);

        $pemasukan = Transaksi::where('jenis', 'pemasukan')->sum('nominal');
        $pengeluaran = Transaksi::where('jenis', 'pengeluaran')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        // Pastikan view ini ada di resources/views/transaksi/index.blade.php
        return view('transaksi.index', [
            'dataTransaksi' => $dataTransaksi,
            'saldo' => $saldo,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran
        ]);
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required|min:5|max:100',
            'nominal' => 'required|numeric|min:1000',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date'
        ]);

        Transaksi::create($validated);

        return redirect('/')->with('success', 'Data transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.edit', ['data' => $transaksi]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'keterangan' => 'required|min:5|max:100',
            'nominal' => 'required|numeric|min:1000',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date'
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        return redirect('/')->with('success', 'Data transaksi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect('/')->with('success', 'Data berhasil dihapus!');
    }

    // PERBAIKAN DI SINI
    public function laporan()
    {
        $totalPemasukan = Transaksi::where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = Transaksi::where('jenis', 'pengeluaran')->sum('nominal');

        return view('transaksi.laporan', [
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran
        ]);
    }
}
