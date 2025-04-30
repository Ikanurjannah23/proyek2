<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelolaKeranjangPesanan extends Model
{
    // Menentukan nama tabel
    protected $table = 'kelola_keranjang_pesanans';

    // Jika ada kolom-kolom yang perlu diisi secara massal, bisa didefinisikan di sini
    protected $fillable = ['kolom1', 'kolom2', 'kolom3']; // sesuaikan dengan kolom di tabel Anda
}
