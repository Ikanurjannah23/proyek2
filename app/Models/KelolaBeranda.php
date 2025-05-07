<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaBeranda extends Model
{
    use HasFactory;

    protected $table = 'kelolaberanda';

    protected $fillable = [
        'judul',
        'gambar',
        'tanggal',
        'deskripsi_singkat',
        'isi_artikel',
    ];
}
