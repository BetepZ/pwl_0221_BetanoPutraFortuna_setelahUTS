<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('transaksi')->insert([
            [
                'keterangan' => 'Gaji Bulanan',
                'nominal' => 5000000,
                'jenis' => 'pemasukan',
                'tanggal' => '2025-11-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Belanja Bulanan',
                'nominal' => 1500000,
                'jenis' => 'pengeluaran',
                'tanggal' => '2025-11-02',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
