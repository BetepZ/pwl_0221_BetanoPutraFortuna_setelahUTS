<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib import ini untuk database

class TransaksiController extends Controller
{
    // Menampilkan halaman Dashboard
    public function index()
    {
        // KITA UBAH: Ambil data dari Database (bukan array manual lagi)
        $transaksi = DB::table('transaksi')->orderBy('tanggal', 'desc')->get();

        // Hitung saldo dari database
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

    // Menampilkan Form Tambah Data
    public function create()
    {
        return view('transaksi.create');
    }

    // Memproses Data Input (Simpan Baru)
    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|min:5|max:100',
            'nominal' => 'required|numeric|min:1000',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date'
        ]);

        // Simpan ke Database
        DB::table('transaksi')->insert([
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
            'jenis' => $request->jenis,
            'tanggal' => $request->tanggal,
            'created_at' => now() // Opsional
        ]);

        return redirect('/')->with('success', 'Data transaksi berhasil ditambahkan!');
    }

    // --- TUGAS NOMOR 1: MENAMPILKAN HALAMAN EDIT ---
    public function edit($id)
    {
        // Ambil data berdasarkan ID
        $transaksi = DB::table('transaksi')->where('id', $id)->first();

        // Kirim data ke view edit
        return view('transaksi.edit', ['data' => $transaksi]);
    }

    // --- TUGAS NOMOR 2: UPDATE DATA (Sertakan ini agar form bisa disave nanti) ---
    public function update(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|min:5|max:100',
            'nominal' => 'required|numeric|min:1000',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date'
        ]);

        DB::table('transaksi')->where('id', $request->id)->update([
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
            'jenis' => $request->jenis,
            'tanggal' => $request->tanggal
        ]);

        return redirect('/')->with('success', 'Data transaksi berhasil diupdate!');
    }
}
