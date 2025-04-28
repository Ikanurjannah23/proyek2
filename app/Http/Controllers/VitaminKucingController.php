<?php

namespace App\Http\Controllers;

use App\Models\VitaminKucing;
use Illuminate\Http\Request;

class VitaminKucingController extends Controller
{
    public function index()
    {
        $vitamins = VitaminKucing::all();
        return view('vitaminkucing.index', compact('vitamins')); // Pastikan $vitamins dikirim ke view
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
