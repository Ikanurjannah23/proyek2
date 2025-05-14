<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaStatusPesanan;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Ambil notifikasi dari Midtrans
        $notif = new Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $grossAmount = $notif->gross_amount;

        // Simpan ke database hanya jika pembayaran sukses
        if ($transaction === 'capture' || $transaction === 'settlement') {
            // Data dummy karena tidak ada user_id dalam notifikasi
            KelolaStatusPesanan::create([
                'nama_pemesan' => 'Pelanggan Midtrans',
                'nama_produk' => 'Produk dari Order ID: ' . $orderId,
                'qty' => 1,
                'harga' => $grossAmount,
                'metode_pembayaran' => $type,
                'status_pesanan' => 'dibayar',
                'tanggal_pesanan' => now(),
            ]);
        }

        return response()->json(['message' => 'Callback diterima'], 200);
    }
}
