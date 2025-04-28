<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaAdminController extends Controller
{
    public function index()
    {
        // Cek jika ada pesan sukses yang sudah diset di session
        if (session('success')) {
            return view('index')->with('success', session('success'));  // Kirim pesan sukses ke view
        }

        // Jika tidak ada pesan sukses, langsung tampilkan halaman
        return view('index');
    }
}
