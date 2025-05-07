<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaStatusPesanan;

class KelolaStatusPesananController extends Controller
{
    public function index()
    {
        // Mengambil data status pesanan yang sudah diurutkan berdasarkan waktu terbaru
        $statusPesanan = KelolaStatusPesanan::orderBy('created_at', 'desc')->get();
        return view('kelolastatuspesanan.index', compact('statusPesanan'));
    }
    
    public function create()
    {
        return view('kelolastatuspesanan.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'status_pesanan' => 'required|string|max:100',
            'qty' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:ewallet,COD',
        ]);

        // Simpan data pesanan baru
        KelolaStatusPesanan::create([
            'nama_pemesan' => $request->nama_pemesan,
            'nama_produk' => $request->nama_produk, // Pastikan kolom ini ada di database
            'status_pesanan' => $request->status_pesanan,
            'qty' => $request->qty,
            'metode_pembayaran' => $request->metode_pembayaran,
            'harga' => $request->harga, // Pastikan kolom harga ada jika dibutuhkan
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect setelah sukses
        return redirect()->route('kelolastatuspesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function edit(KelolaStatusPesanan $kelolastatuspesanan)
    {
        return view('kelolastatuspesanan.edit', compact('kelolastatuspesanan'));
    }

    public function update(Request $request, KelolaStatusPesanan $kelolastatuspesanan)
    {
        // Validasi inputan
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'status_pesanan' => 'required|string|max:100',
            'qty' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:ewallet,COD',
        ]);

        // Update data pesanan yang ada
        $kelolastatuspesanan->update([
            'nama_pemesan' => $request->nama_pemesan,
            'status_pesanan' => $request->status_pesanan,
            'qty' => $request->qty,
            'metode_pembayaran' => $request->metode_pembayaran,
            'updated_at' => now(),
        ]);

        // Redirect setelah sukses
        return redirect()->route('kelolastatuspesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(KelolaStatusPesanan $kelolastatuspesanan)
    {
        // Hapus data pesanan
        $kelolastatuspesanan->delete();

        // Redirect setelah sukses
        return redirect()->route('kelolastatuspesanan.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }
}
