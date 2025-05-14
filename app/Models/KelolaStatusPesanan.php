<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaStatusPesanan extends Model
{
    use HasFactory;

    // Nama tabel sesuai konvensi jamak Laravel
    protected $table = 'kelola_status_pesanans';

    public $timestamps = true;

    protected $fillable = [
        'nama_pemesan',
        'no_telepon',
        'alamat', // tambahkan field alamat
        'nama_produk',
        'tanggal_pesanan',
        'status_pesanan',
        'qty',
        'metode_pembayaran',
        'harga',
    ];

    protected $dates = ['tanggal_pesanan'];
}
