<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perlengkapan extends Model
{
    protected $table = 'perlengkapan';

    protected $fillable = [
        'nama',
        'jenis',
        'jumlah_stok',
        'harga',
        'deskripsi',
        'gambar',
    ];
}
