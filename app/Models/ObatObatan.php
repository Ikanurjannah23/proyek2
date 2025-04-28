<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObatObatan extends Model
{
    protected $table = 'obatobatan';

    protected $fillable = [
        'nama',
        'jenis',
        'jumlah_stok',
        'harga',
        'deskripsi',
        'gambar',
    ];
}
