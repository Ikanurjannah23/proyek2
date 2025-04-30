<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    protected $table = 'laporan_penjualans'; // Sesuaikan dengan nama tabel di database
    protected $fillable = ['nama_produk', 'kategori', 'jumlah_terjual', 'harga_satuan', 'total_penjualan', 'tanggal']; // Sesuaikan dengan kolom di tabel
}
