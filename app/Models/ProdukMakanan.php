<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukMakanan extends Model
{
    use HasFactory;

    protected $table = 'produkmakanan'; // Nama tabel di database

    protected $fillable = [
        'nama_produk',
        'jenis_produk',
        'jumlah_stok',
        'harga',
        'deskripsi',
        'gambar'
    ];
}
