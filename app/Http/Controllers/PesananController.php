<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaStatusPesanan;

class PesananController extends Controller
{
    public function index()
    {
        // Ambil data pesanan dan urutkan berdasarkan waktu terbaru, lalu paginate
        $pesanan = KelolaStatusPesanan::orderBy('created_at', 'desc')->paginate(5);

        return view('pelanggan.pesanan', compact('pesanan'));
    }
}
