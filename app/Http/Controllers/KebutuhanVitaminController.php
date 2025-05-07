<?php

namespace App\Http\Controllers;

use App\Models\VitaminKucing;
use Illuminate\Http\Request;

class KebutuhanVitaminController extends Controller
{
    public function index()
    {
        $vitamins = VitaminKucing::all();
        return view('pelanggan.kebutuhanvitamin', compact('vitamins'));
    }

    public function show($id)
    {
        $item = VitaminKucing::findOrFail($id);
        return view('pelanggan.detailvitamin', compact('item'));
    }
}
