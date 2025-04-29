@extends('layouts')

@section('title', 'Laporan Penjualan')

@section('content')
<style>
    #laporanTable th,
    #laporanTable td {
        border: 1px solid #000;
        vertical-align: middle;
        background-color: #E5CBB7;
    }

    #laporanTable thead th {
        background-color: #D9D9D9;
    }

    /* Tambahan styling agar sesuai permintaan */
    .custom-box {
        background-color: #D9D9D9 !important;
    }

    .form-select.custom-box {
        background-color: #D9D9D9 !important;
    }
</style>

<div class="container my-5">
    <h2 class="text-center fw-bold mb-4">Laporan Penjualan per Bulan</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="border p-3 rounded custom-box">
            <strong>Total Penjualan Bulan ini</strong><br>
            <span class="fs-5 fw-bold">Rp. 1.500.000</span>
        </div>

        <div class="d-flex gap-2">
            <select class="form-select custom-box">
                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                    <option value="{{ $bulan }}" {{ $bulan == 'April' ? 'selected' : '' }}>{{ $bulan }}</option>
                @endforeach
            </select>
            <select class="form-select custom-box">
                @for ($tahun = 2023; $tahun <= 2028; $tahun++)
                    <option value="{{ $tahun }}" {{ $tahun == 2025 ? 'selected' : '' }}>{{ $tahun }}</option>
                @endfor
            </select>
        </div>
    </div>

    {{-- TABEL --}}
    <table class="table text-center mt-4" id="laporanTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Jumlah Terjual</th>
                <th>Harga Satuan</th>
                <th>Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Whiskas Tuna 1.2 kg</td>
                <td>Makanan</td>
                <td>20</td>
                <td>Rp. 18.000</td>
                <td>Rp. 360.000</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Kalung Kucing</td>
                <td>Aksesoris</td>
                <td>14</td>
                <td>Rp. 9.000</td>
                <td>Rp. 126.000</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
