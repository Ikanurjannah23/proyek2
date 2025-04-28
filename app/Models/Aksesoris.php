<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aksesoris extends Model
{
    use HasFactory;

    protected $table = 'aksesoris'; // Nama tabel di database

    protected $fillable = [
        'nama',
        'jenis',
        'jumlah_stok',
        'harga', // Harga disimpan sebagai string
        'deskripsi',
        'gambar'
    ];
}
