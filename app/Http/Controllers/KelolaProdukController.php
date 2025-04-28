<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaProdukController extends Controller
{
    public function index()
    {
        $produk = [
            ['nama' => 'Makanan Kucing', 'icon' => 'utensils'],
            ['nama' => 'Aksesoris', 'icon' => 'paw'],
            ['nama' => 'Obat obatan', 'icon' => 'pills'],
            ['nama' => 'Perlengkapan', 'icon' => 'tshirt'],
            ['nama' => 'Vitamin Kucing', 'icon' => 'prescription-bottle']
        ];

        return view('kelola_produk.kelolaproduk', compact('produk'));
    }
}

