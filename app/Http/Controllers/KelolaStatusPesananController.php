<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaStatusPesanan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class KelolaStatusPesananController extends Controller
{
    public function index()
    {
        $statusPesanan = KelolaStatusPesanan::latest()->get();
        return view('kelolastatuspesanan.index', compact('statusPesanan'));
    }

    public function create()
    {
        return view('kelolastatuspesanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'nama_produk' => 'required|string|max:255',
            'status_pesanan' => 'required|string|max:100',
            'qty' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:ewallet,COD',
            'harga' => 'required|numeric|min:0',
            'alamat' => 'nullable|string|max:255',
        ]);

        KelolaStatusPesanan::create(array_merge($validated, [
            'status_pesanan' => 'Menunggu Konfirmasi',
            'tanggal_pesanan' => now(),
        ]));

        return redirect()->route('kelolastatuspesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function edit(KelolaStatusPesanan $kelolastatuspesanan)
    {
        return view('kelolastatuspesanan.edit', compact('kelolastatuspesanan'));
    }

    public function update(Request $request, KelolaStatusPesanan $kelolastatuspesanan)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'status_pesanan' => 'required|string|max:100',
            'qty' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:ewallet,COD',
            'harga' => 'nullable|numeric|min:0',
            'alamat' => 'nullable|string|max:255',
        ]);

        $kelolastatuspesanan->update($validated);

        return redirect()->route('kelolastatuspesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(KelolaStatusPesanan $kelolastatuspesanan)
    {
        $kelolastatuspesanan->delete();
        return redirect()->route('kelolastatuspesanan.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    // ✅ Untuk pelanggan, simpan pesanan & kirim WA otomatis (dipanggil oleh pelanggan)
    public function simpanPesanan(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_pemesan' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:20',
                'nama_produk' => 'required|string|max:255',
                'qty' => 'required|integer|min:1',
                'metode_pembayaran' => 'required|in:ewallet,COD',
                'total' => 'required|numeric|min:0',
                'alamat' => 'nullable|string|max:255',
            ]);

            $pesanan = KelolaStatusPesanan::create([
                'nama_pemesan' => $validated['nama_pemesan'],
                'no_telepon' => $validated['no_telepon'],
                'nama_produk' => $validated['nama_produk'],
                'qty' => $validated['qty'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'harga' => $validated['total'],
                'status_pesanan' => 'Menunggu Konfirmasi',
                'tanggal_pesanan' => now(),
                'alamat' => $validated['alamat'] ?? null,
            ]);

            // Kirim WA otomatis
            $this->kirimPesanWhatsapp(
                $validated['no_telepon'],
                $validated['nama_pemesan'],
                $validated['nama_produk'],
                $validated['qty'],
                $validated['total']
            );

            return response()->json(['message' => 'Pesanan disimpan & WhatsApp dikirim.'], 200);
        } catch (\Exception $e) {
            Log::error('Exception simpanPesanan: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan.'], 500);
        }
    }

    // ✅ Tombol kirim WA manual di admin
    public function kirimWaManual(Request $request)
    {
        try {
            $request->validate([
                'no_telepon' => 'required|string|max:20',
                'pesan' => 'required|string',
            ]);

            $this->kirimWhatsApp($request->no_telepon, $request->pesan);

            return response()->json(['message' => 'Pesan WhatsApp berhasil dikirim.']);
        } catch (\Exception $e) {
            Log::error('Kirim WA manual error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal kirim WA'], 500);
        }
    }

    // ✅ Fungsi utama kirim ke WhatsApp (dipakai otomatis & manual)
    protected function kirimWhatsApp($nomor, $pesan)
    {
        $sid   = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from  = config('services.twilio.from');

        if (!$sid || !$token || !$from) {
            throw new \Exception('Konfigurasi Twilio tidak lengkap di config/services.php');
        }

        $nomor = preg_replace('/[^0-9]/', '', $nomor);
        $nomor = preg_replace('/^0/', '62', $nomor);
        $to = "whatsapp:+{$nomor}";

        $response = Http::withBasicAuth($sid, $token)->asForm()->post(
            "https://api.twilio.com/2010-04-01/Accounts/{$sid}/Messages.json",
            [
                'From' => $from,
                'To' => $to,
                'Body' => $pesan,
            ]
        );

        if (!$response->successful()) {
            throw new \Exception('Gagal mengirim pesan ke Twilio: ' . $response->body());
        }
    }

    // ✅ Format pesan WhatsApp
    protected function kirimPesanWhatsapp($no_telepon, $nama, $produk, $qty, $total)
    {
        $formattedTotal = number_format($total, 0, ',', '.');

        $pesan = "Hai *{$nama}*,\n"
               . "Pesanan Anda untuk *{$produk}* sebanyak *{$qty} pcs* telah kami terima.\n"
               . "Total: *Rp{$formattedTotal}*\n"
               . "Status: *Menunggu Konfirmasi*.\n\n"
               . "Terima kasih telah berbelanja di toko kami! 🐾";

        $this->kirimWhatsApp($no_telepon, $pesan);
    }
}
