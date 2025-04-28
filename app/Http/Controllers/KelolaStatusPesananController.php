<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaStatusPesanan;

class KelolaStatusPesananController extends Controller
{
    public function index()
    {
        $statusPesanan = KelolaStatusPesanan::orderBy('created_at', 'desc')->get(); // Ambil semua data, urutkan dari yang terbaru
        return view('kelolastatuspesanan.index', compact('statusPesanan'));
    }
    
    public function create()
    {
        return view('kelolastatuspesanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'status_pesanan' => 'required|string|max:100',
        ]);

        KelolaStatusPesanan::create([
            'nama_pemesan' => $request->nama_pemesan,
            'status_pesanan' => $request->status_pesanan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('kelolastatuspesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function edit(KelolaStatusPesanan $kelolastatuspesanan)
    {
        return view('kelolastatuspesanan.edit', compact('kelolastatuspesanan'));
    }

    public function update(Request $request, KelolaStatusPesanan $kelolastatuspesanan)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'status_pesanan' => 'required|string|max:100',
        ]);

        $kelolastatuspesanan->update([
            'nama_pemesan' => $request->nama_pemesan,
            'status_pesanan' => $request->status_pesanan,
            'updated_at' => now(),
        ]);

        return redirect()->route('kelolastatuspesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(KelolaStatusPesanan $kelolastatuspesanan)
    {
        $kelolastatuspesanan->delete();

        return redirect()->route('kelolastatuspesanan.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }
}
