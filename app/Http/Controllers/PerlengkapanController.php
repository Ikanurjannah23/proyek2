<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perlengkapan;
use Illuminate\Support\Facades\Storage;

class PerlengkapanController extends Controller
{
    public function index()
    {
        $data = Perlengkapan::all();
        return view('perlengkapan.index', ['perlengkapan' => $data]);
    }

    public function create()
    {
        return view('perlengkapan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah_stok' => 'required|integer',
            'harga' => 'required|string',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('gambar_perlengkapan', 'public');
        }

        Perlengkapan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah_stok' => $request->jumlah_stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()->route('perlengkapan.index')->with('success', 'Berhasil menambahkan perlengkapan!');
    }

    public function edit($id)
{
    $perlengkapan = Perlengkapan::findOrFail($id);
    return view('perlengkapan.edit', compact('perlengkapan'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah_stok' => 'required|integer',
            'harga' => 'required|string',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = Perlengkapan::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($data->gambar) {
                Storage::disk('public')->delete($data->gambar);
            }
            $gambar = $request->file('gambar')->store('gambar_perlengkapan', 'public');
        } else {
            $gambar = $data->gambar;
        }

        $data->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah_stok' => $request->jumlah_stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()->route('perlengkapan.index')->with('success', 'Berhasil mengedit perlengkapan!');
    }

    public function destroy($id)
    {
        $data = Perlengkapan::findOrFail($id);

        if ($data->gambar) {
            Storage::disk('public')->delete($data->gambar);
        }

        $data->delete();
        return redirect()->route('perlengkapan.index')->with('success', 'Berhasil menghapus perlengkapan!');
    }
}
