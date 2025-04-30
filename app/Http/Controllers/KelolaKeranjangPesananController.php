<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaKeranjangPesanan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KelolaKeranjangPesananController extends Controller
{
    // Menampilkan semua data keranjang pesanan
    public function index()
    {
        // Mengambil semua data dari model KelolaKeranjangPesanan
        $keranjangPesanans = KelolaKeranjangPesanan::all();
        // Mengirim data ke view dengan nama variabel yang benar
        return view('kelolakeranjangpesanan.index', compact('keranjangPesanans'));
    }

    // Menampilkan form untuk menambah keranjang pesanan baru
    public function create()
    {
        // Mengambil data user untuk dropdown
        $users = User::all();
    
        // Mengambil data produk secara manual menggunakan query builder
        $produk = DB::table('produks')->get();  // Asumsikan nama tabel produk adalah 'produks'
    
        return view('kelolakeranjangpesanan.create', compact('users', 'produk'));
    }
    

    // Menampilkan form untuk mengedit keranjang pesanan
    public function edit($id)
    {
        // Mengambil data keranjang berdasarkan ID
        $item = KelolaKeranjangPesanan::findOrFail($id);
        
        // Mengambil data user dan produk untuk dropdown
        $users = User::all();
        $produk = Produk::all();

        // Mengembalikan tampilan dengan data yang diperlukan
        return view('kelolakeranjangpesanan.edit', compact('item', 'users', 'produk'));
    }

    // Menyimpan data keranjang pesanan baru
    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',  // Pastikan user_id valid
            'produk_id' => 'required|exists:produk,id',  // Pastikan produk_id valid
            'jumlah' => 'required|integer|min:1',  // Pastikan jumlah valid
        ]);

        // Menyimpan data keranjang pesanan
        KelolaKeranjangPesanan::create([
            'user_id' => $validated['user_id'],
            'produk_id' => $validated['produk_id'],
            'jumlah' => $validated['jumlah'],
        ]);

        // Mengalihkan kembali dengan pesan sukses
        return redirect()->route('kelolakeranjangpesanan')->with('success', 'Keranjang Pesanan berhasil ditambahkan!');
    }

    // Memperbarui data keranjang pesanan yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi input form
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',  // Pastikan user_id valid
            'produk_id' => 'required|exists:produk,id',  // Pastikan produk_id valid
            'jumlah' => 'required|integer|min:1',  // Pastikan jumlah valid
        ]);

        // Menemukan data keranjang berdasarkan ID
        $keranjangPesanan = KelolaKeranjangPesanan::findOrFail($id);

        // Memperbarui data keranjang
        $keranjangPesanan->update([
            'user_id' => $validated['user_id'],
            'produk_id' => $validated['produk_id'],
            'jumlah' => $validated['jumlah'],
        ]);

        // Mengalihkan kembali dengan pesan sukses
        return redirect()->route('kelolakeranjangpesanan')->with('success', 'Keranjang Pesanan berhasil diperbarui!');
    }
}
