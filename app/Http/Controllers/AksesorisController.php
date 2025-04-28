<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aksesoris;
use Illuminate\Support\Facades\Storage;

class AksesorisController extends Controller
{
    public function index()
    {
        $aksesoris = Aksesoris::all();
        return view('aksesoris.index', compact('aksesoris'));
    }

    public function create()
    {
        return view('aksesoris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah_stok' => 'required',
            'harga' => 'required|string',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar_aksesoris', 'public');
        }

        Aksesoris::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah_stok' => $request->jumlah_stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('aksesoris.index')->with('success', 'Aksesoris berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $aksesoris = Aksesoris::findOrFail($id);
        return view('aksesoris.edit', compact('aksesoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah_stok' => 'required',
            'harga' => 'required|string',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $aksesoris = Aksesoris::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($aksesoris->gambar) {
                Storage::disk('public')->delete($aksesoris->gambar);
            }
            $gambarPath = $request->file('gambar')->store('gambar_aksesoris', 'public');
        } else {
            $gambarPath = $aksesoris->gambar;
        }

        $aksesoris->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah_stok' => $request->jumlah_stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('aksesoris.index')->with('success', 'Aksesoris berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $aksesoris = Aksesoris::findOrFail($id);

        if ($aksesoris->gambar) {
            Storage::disk('public')->delete($aksesoris->gambar);
        }

        $aksesoris->delete();
        return redirect()->route('aksesoris.index')->with('success', 'Aksesoris berhasil dihapus!');
    }
}
