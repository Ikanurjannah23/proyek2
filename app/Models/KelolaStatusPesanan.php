<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaStatusPesanan extends Model
{
    use HasFactory;

    // Nama tabel di database (HARUS sesuai dengan migration)
    protected $table = 'kelola_status_pesanans'; 

    // Aktifkan timestamps
    public $timestamps = true; // Pastikan timestamps aktif

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'nama_pemesan', 
        'nama_produk', 
        'tanggal_pesanan', 
        'status_pesanan', 
        'harga'
    ];

    // Pastikan Laravel mengenali 'tanggal_pesanan' sebagai tanggal
    protected $dates = ['tanggal_pesanan'];
}