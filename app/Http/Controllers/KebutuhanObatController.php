<?php

namespace App\Http\Controllers;

use App\Models\ObatObatan;

class KebutuhanObatController extends Controller
{
    public function index()
    {
        $obat = ObatObatan::all();
        return view('pelanggan.kebutuhanobat', compact('obat'));
    }

    public function show($id)
    {
        $obat = ObatObatan::findOrFail($id);
        return view('pelanggan.detailobat', compact('obat'));
    }
}
