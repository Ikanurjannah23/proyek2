<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaStatusPesanan extends Model
{
    use HasFactory;

    protected $table = 'kelola_status_pesanans';

    public $timestamps = true;

    protected $fillable = [
        'nama_pemesan',
        'nama_produk',
        'tanggal_pesanan',
        'status_pesanan',
        'qty',
        'metode_pembayaran',
        'harga',
    ];

    protected $dates = ['tanggal_pesanan'];
}
