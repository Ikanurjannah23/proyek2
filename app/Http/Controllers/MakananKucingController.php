<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukMakanan;

class MakananKucingController extends Controller
{
    public function index()
    {
        $produks = ProdukMakanan::all(); // Ambil semua produk, tanpa filter jenis
        return view('pelanggan.makanankucing', compact('produks'));
    }

    public function show($id)
    {
        $produk = ProdukMakanan::findOrFail($id);
        return view('pelanggan.detailmakanankucing', compact('produk'));
    }
}
