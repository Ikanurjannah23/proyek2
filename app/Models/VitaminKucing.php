<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitaminKucing extends Model
{
    use HasFactory;

    protected $table = 'vitaminkucing';

    protected $fillable = [
        'nama_produk', 'jenis_produk', 'stok', 'harga', 'deskripsi', 'gambar'
    ];
}

