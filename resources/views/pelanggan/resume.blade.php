<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Pemesanan</title>
    <!-- Add your custom CSS or Bootstrap here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .order-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .btn-order {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            padding: 10px;
        }
        .btn-order:hover {
            background-color: #218838;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
            padding: 10px;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    
    @include('pelanggan.sidebar')
    
    <div class="container py-5">
        <h4 class="mb-4">Ringkasan Pemesanan</h4>
        <p><strong>Nama:</strong> {{ $data['nama_pemesan'] }}</p>
        <p><strong>Produk:</strong> {{ $data['nama_produk'] }}</p>
        <p><strong>Jumlah:</strong> {{ $data['qty'] }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($data['total'], 0, ',', '.') }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ $data['metode_pembayaran'] }}</p>
    
        <form action="{{ route('formpesanan.pembayaran') }}" method="POST">
            @csrf
            <input type="hidden" name="total_harga" value="{{ $data['total'] }}">
            <button type="submit" class="btn btn-success w-100">Bayar Sekarang</button>
        </form>
        <a href="{{ route('formpesanan.show', ['jenis' => $data['jenis'], 'id' => $data['produk_id']]) }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
    </div>
    
    @include('layouts.footer')
    
    </body>
    </html>
    