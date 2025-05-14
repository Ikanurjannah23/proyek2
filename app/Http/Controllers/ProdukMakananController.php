<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukMakanan;
use Illuminate\Support\Facades\Storage;

class ProdukMakananController extends Controller
{
    public function index()
    {
        $produks = ProdukMakanan::all();
        return view('produkmakanan.index', compact('produks')); // Pastikan $produks dikirim ke view
    }
    
    public function create()
    {
        return view('produkmakanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'   => 'required|string|max:255',
            'jenis_produk'  => 'required|string|max:100',
            'jumlah_stok'   => 'required|integer|min:0',
            'harga'         => 'required|string',
            'deskripsi'     => 'nullable|string',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_produk', 'jenis_produk', 'jumlah_stok', 'harga', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        ProdukMakanan::create($data);

        return redirect()->route('produkmakanan.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = ProdukMakanan::findOrFail($id);
        return view('produkmakanan.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = ProdukMakanan::findOrFail($id);

        $request->validate([
            'nama_produk'   => 'required|string|max:255',
            'jenis_produk'  => 'required|string|max:100',
            'jumlah_stok'   => 'required|integer|min:0',
            'harga'         => 'required|string',
            'deskripsi'     => 'nullable|string',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_produk', 'jenis_produk', 'jumlah_stok', 'harga', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produkmakanan.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = ProdukMakanan::findOrFail($id);

        // Hapus gambar jika ada
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produkmakanan.index')->with('success', 'Produk berhasil dihapus!');
    }
    public function cari(Request $request)
{
    $keyword = $request->search;

    // Ambil data produk berdasarkan keyword pencarian
    $produks = ProdukMakanan::where('nama_produk', 'like', "%{$keyword}%")->get();

    // Kirimkan hasil ke view partial (hanya bagian tabel)
    return view('pelanggan.partialproduk', compact('produks'));
}

}