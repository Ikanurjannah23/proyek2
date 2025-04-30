<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPenjualan; // Gunakan model LaporanPenjualan

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan dan tahun dari input, jika tidak ada gunakan bulan dan tahun saat ini
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Query data laporan penjualan berdasarkan bulan dan tahun
        $laporans = LaporanPenjualan::whereMonth('tanggal', $bulan) // Sesuaikan dengan kolom tanggal
                                    ->whereYear('tanggal', $tahun)
                                    ->get();

        // Kirim data ke view
        return view('laporan_penjualan.index', compact('laporans'));
    }
}
