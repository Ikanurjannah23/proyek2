<?php

namespace App\Http\Controllers;

use App\Models\KelolaBeranda;
use Illuminate\Http\Request;

class KelolaBerandaController extends Controller
{
    // Menampilkan semua artikel
    public function index()
    {
        // Ambil semua data artikel dari model
        $artikels = KelolaBeranda::all();

        // Kembalikan view dengan data artikel yang diteruskan ke view
        return view('kelolaberanda.index', compact('artikels'));
    }

    // Menampilkan form untuk menambah artikel
    public function create()
    {
        return view('kelolaberanda.create');
    }

    // Menyimpan artikel baru
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png',
            'tanggal' => 'required|date',
            'deskripsi_singkat' => 'required|string',
            'isi_artikel' => 'required|string',
        ]);

        // Proses gambar dan simpan di storage
        $gambarPath = $request->file('gambar')->store('gambar_beranda', 'public');
        $data['gambar'] = $gambarPath;

        // Simpan data artikel ke database
        KelolaBeranda::create($data);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelolaberanda.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit artikel
    public function edit($id)
    {
        $artikel = KelolaBeranda::findOrFail($id); // Ambil data artikel berdasarkan ID
        return view('kelolaberanda.edit', compact('artikel'));
    }

    // Memperbarui artikel
    public function update(Request $request, $id)
    {
        $artikel = KelolaBeranda::findOrFail($id); // Ambil artikel yang ingin diupdate

        // Validasi data yang dikirim dari form
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
            'tanggal' => 'required|date',
            'deskripsi_singkat' => 'required|string',
            'isi_artikel' => 'required|string',
        ]);

        // Jika ada gambar baru, upload gambar tersebut
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar_beranda', 'public');
        }

        // Update artikel di database
        $artikel->update($data);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelolaberanda.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    // Menghapus artikel
    public function destroy($id)
    {
        $artikel = KelolaBeranda::findOrFail($id); // Ambil artikel yang ingin dihapus
        $artikel->delete(); // Hapus artikel dari database

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelolaberanda.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
