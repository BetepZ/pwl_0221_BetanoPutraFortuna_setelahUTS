<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Halaman Dashboard
    public function index()
    {
        $transaksi = DB::table('transaksi')->orderBy('tanggal', 'desc')->get();

        $pemasukan = DB::table('transaksi')->where('jenis', 'pemasukan')->sum('nominal');
        $pengeluaran = DB::table('transaksi')->where('jenis', 'pengeluaran')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        return view('transaksi.index', [
            'dataTransaksi' => $transaksi,
            'saldo' => $saldo,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran
        ]);
    }

    // Halaman Tambah
    public function create()
    {
        return view('transaksi.create');
    }

    // Proses Simpan
    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|min:5|max:100',
            'nominal' => 'required|numeric|min:1000',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date'
        ]);

        DB::table('transaksi')->insert([
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
            'jenis' => $request->jenis,
            'tanggal' => $request->tanggal,
            'created_at' => now()
        ]);

        return redirect('/')->with('success', 'Data transaksi berhasil ditambahkan!');
    }

    // Halaman Edit
    public function edit($id)
    {
        $transaksi = DB::table('transaksi')->where('id', $id)->first();
        return view('transaksi.edit', ['data' => $transaksi]);
    }

    // Proses Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|min:5|max:100',
            'nominal' => 'required|numeric|min:1000',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date'
        ]);

        DB::table('transaksi')->where('id', $id)->update([
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
            'jenis' => $request->jenis,
            'tanggal' => $request->tanggal
        ]);

        return redirect('/')->with('success', 'Data transaksi berhasil diupdate!');
    }

    // --- TUGAS NO 3: FUNGSI HAPUS ---
    public function destroy($id)
    {
        // Hapus data dari database
        DB::table('transaksi')->where('id', $id)->delete();

        // Redirect balik dengan pesan
        return redirect('/')->with('success', 'Data transaksi berhasil dihapus!');
    }

    public function laporan()
    {
        // Hitung total pemasukan dan pengeluaran dari database
        $totalPemasukan = \Illuminate\Support\Facades\DB::table('transaksi')
            ->where('jenis', 'pemasukan')
            ->sum('nominal');

        $totalPengeluaran = \Illuminate\Support\Facades\DB::table('transaksi')
            ->where('jenis', 'pengeluaran')
            ->sum('nominal');

        // Kirim datanya ke view laporan
        return view('laporan', [
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran
        ]);
    }
}
