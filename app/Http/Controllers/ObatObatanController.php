<?php

namespace App\Http\Controllers;

use App\Models\ObatObatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObatObatanController extends Controller
{
    public function index()
    {
        $data = ObatObatan::all();
        return view('obatobatan.index', compact('data'));
    }

    public function create()
    {
        return view('obatobatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah_stok' => 'required',
            'harga' => 'required',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambarPath = $request->file('gambar') ? $request->file('gambar')->store('gambar_obat', 'public') : null;

        ObatObatan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah_stok' => $request->jumlah_stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('obatobatan.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $obat = ObatObatan::findOrFail($id);
        return view('obatobatan.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $obat = ObatObatan::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah_stok' => 'required',
            'harga' => 'required',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            if ($obat->gambar) Storage::disk('public')->delete($obat->gambar);
            $obat->gambar = $request->file('gambar')->store('gambar_obat', 'public');
        }

        $obat->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah_stok' => $request->jumlah_stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $obat->gambar,
        ]);

        return redirect()->route('obatobatan.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = ObatObatan::findOrFail($id);
        if ($obat->gambar) Storage::disk('public')->delete($obat->gambar);
        $obat->delete();

        return redirect()->route('obatobatan.index')->with('success', 'Obat berhasil dihapus.');
    }
}
