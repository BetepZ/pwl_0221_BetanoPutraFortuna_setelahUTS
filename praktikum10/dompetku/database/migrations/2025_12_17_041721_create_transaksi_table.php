<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id(); // Ini otomatis membuat kolom 'id' (Primary Key, Auto Increment)
            $table->string('keterangan'); // Kolom 'keterangan' (String/Varchar)
            $table->date('tanggal');      // Kolom 'tanggal' (Date)

            // Kolom 'jenis' hanya boleh 'pemasukan' atau 'pengeluaran'
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);

            $table->integer('nominal');   // Kolom 'nominal' (Integer)

            $table->timestamps(); // Otomatis membuat 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
