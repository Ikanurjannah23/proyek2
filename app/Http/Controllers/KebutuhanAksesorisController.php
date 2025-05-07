<?php

namespace App\Http\Controllers;

use App\Models\Aksesoris;
use Illuminate\Http\Request;

class KebutuhanAksesorisController extends Controller
{
    public function index()
    {
        $aksesoris = Aksesoris::all();
        return view('pelanggan.kebutuhanaksesoris', compact('aksesoris'));
    }

    public function show($id)
    {
        $aksesoris = Aksesoris::findOrFail($id);
        return view('pelanggan.detailaksesoris', compact('aksesoris'));
    }
}
