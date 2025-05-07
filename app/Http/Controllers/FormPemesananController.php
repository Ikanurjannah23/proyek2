<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukMakanan;
use App\Models\Aksesoris;
use App\Models\ObatObatan;
use App\Models\Perlengkapan;
use App\Models\VitaminKucing;
use App\Models\KelolaStatusPesanan;
use Midtrans\Config;
use Midtrans\Snap;


class FormPemesananController extends Controller
{
    public function show($jenis, $id)
    {
        $produk = $this->findProduk($jenis, $id);
        return view('pelanggan.formpesanan', compact('produk', 'jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'qty' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|in:COD,Dana',
            'tanggal_pesan' => 'required|date',
            'produk_id' => 'required',
            'jenis' => 'required',
        ]);
    
        $produk = $this->findProduk($request->jenis, $request->produk_id);
        $totalHarga = (int)$produk->harga * $request->qty;
    
        // Simpan data ke session untuk halaman resume
        $data = $request->all();
        $data['nama_produk'] = $this->getNamaProduk($produk);
        $data['harga'] = $produk->harga;
        $data['total'] = $totalHarga;
    
        session(['data_pesanan' => $data]);
    
        return redirect()->route('formpesanan.resume');
    }
    

public function resume()
{
    $data = session('data_pesanan');
    if (!$data) {
        return redirect()->route('berandauser')->with('error', 'Data tidak ditemukan.');
    }

    // Konfigurasi Midtrans Snap
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $snapToken = Snap::getSnapToken([
        'transaction_details' => [
            'order_id' => uniqid(),
            'gross_amount' => $data['total'],
        ],
        'customer_details' => [
            'first_name' => $data['nama_pemesan'],
            'phone' => $data['no_telepon'],
            'email' => 'user@example.com', // tambahkan jika ada
        ],
    ]);

    return view('pelanggan.resume', compact('data', 'snapToken'));
}


    private function findProduk($jenis, $id)
    {
        switch ($jenis) {
            case 'produk':
                return ProdukMakanan::findOrFail($id);
            case 'aksesoris':
                return Aksesoris::findOrFail($id);
            case 'obat':
                return ObatObatan::findOrFail($id);
            case 'perlengkapan':
                return Perlengkapan::findOrFail($id);
            case 'vitamin':
                return VitaminKucing::findOrFail($id);
            default:
                abort(404);
        }
    }
    public function keranjangPesanan()
{
    $pesanan = KelolaStatusPesanan::latest()->get(); // bisa disesuaikan, misalnya hanya untuk user tertentu
    return view('pelanggan.keranjangpesanan', compact('pesanan'));
}
// FormPemesananController.php

public function tambahKeKeranjang(Request $request)
{
    $produk = new KelolaStatusPesanan();
    $produk->produk_id = $request->produk_id;
    $produk->nama_produk = $request->nama_produk;
    $produk->harga = $request->harga;
    $produk->qty = 1;
    $produk->gambar = $request->gambar;
    $produk->save();

    return redirect()->route('keranjang.pesanan')->with('success', 'Produk ditambahkan ke keranjang.');
}

public function hapusPesanan($id)
{
    $pesanan = KelolaStatusPesanan::findOrFail($id);
    $pesanan->delete();

    return redirect()->route('keranjang.pesanan')->with('success', 'Pesanan berhasil dihapus.');
}

    public function pembayaran(Request $request)
{
    $data = session('data_pesanan');
    if (!$data) {
        return redirect()->route('berandauser')->with('error', 'Data tidak ditemukan.');
    }

    // Konfigurasi Midtrans Snap
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $snapToken = Snap::getSnapToken([
        'transaction_details' => [
            'order_id' => uniqid(),
            'gross_amount' => $data['total'],
        ],
        'customer_details' => [
            'first_name' => $data['nama_pemesan'],
            'phone' => $data['no_telepon'],
            'email' => 'user@example.com', // tambahkan jika ada
        ],
    ]);

    return view('pelanggan.pembayaran', compact('snapToken'));
}


    private function getNamaProduk($produk)
    {
        return $produk->nama_produk ?? $produk->nama;
    }
}
