<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaBeranda;

class BerandaUserController extends Controller
{
    public function index()
    {
        $artikels = KelolaBeranda::latest()->get();
        return view('pelanggan.berandauser', compact('artikels'));
    }

    public function show($id)
    {
        $artikel = KelolaBeranda::findOrFail($id);
        return view('pelanggan.detailberandauser', compact('artikel'));
    }
}
