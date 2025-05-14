<?php

namespace App\Http\Controllers;

use App\Models\VitaminKucing;
use Illuminate\Http\Request;
use App\Models\ProdukMakanan;
use App\Models\Aksesoris;
use App\Models\ObatObatan;  // Menambahkan model ObatObatan
use App\Models\Perlengkapan;  // Menambahkan model Perlengkapan


class VitaminKucingController extends Controller
{
    public function index()
    {
        $vitamins = VitaminKucing::all();
        return view('vitaminkucing.index', compact('vitamins')); // Pastikan $vitamins dikirim ke view
    }
    public function tambahKeranjang($id, $kategori)
    {
        // Ambil produk berdasarkan ID dan kategori
        $produk = null;
        switch ($kategori) {
            case 'makanan':
                $produk = ProdukMakanan::find($id);
                break;
            case 'aksesoris':
                $produk = Aksesoris::find($id);
                break;
            case 'vitamin':
                $produk = VitaminKucing::find($id);
                break;
            case 'obatobatan':
                $produk = ObatObatan::find($id);
                break;
            case 'perlengkapan':
                $produk = Perlengkapan::find($id);
                break;
        }
    
        // Simpan produk yang dipilih ke session
        if ($produk) {
            $keranjang = session()->get('keranjang', []);
            $keranjang[] = [
                'id' => $produk->id,
                'kategori' => $kategori,
            ];
    
            session()->put('keranjang', $keranjang);
        }
    
        // Redirect ke halaman keranjang pelanggan
        return redirect()->route('pelanggan.keranjang');
    }
    

    public function create()
    {
        return view('vitaminkucing.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required',
            'jenis_produk' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('vitaminkucing', 'public');
        }

        VitaminKucing::create($data);
        return redirect()->route('vitaminkucing.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = VitaminKucing::findOrFail($id);
        return view('vitaminkucing.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = VitaminKucing::findOrFail($id);
        $data = $request->validate([
            'nama_produk' => 'required',
            'jenis_produk' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('vitaminkucing', 'public');
        }

        $item->update($data);
        return redirect()->route('vitaminkucing.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = VitaminKucing::findOrFail($id);
        $item->delete();
        return redirect()->route('vitaminkucing.index')->with('success', 'Data berhasil dihapus');
    }
}
