<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    //use HasFactory;

    protected $table = 'kontak'; // Merujuk ke tabel 'kontak'

    protected $fillable = [
        'nama',
        'nomor_telepon'
    ]; // Kolom yang boleh diisi
}
