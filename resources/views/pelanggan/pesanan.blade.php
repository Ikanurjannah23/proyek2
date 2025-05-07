<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya | Khakiel PetShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fff9f2;
            font-family: 'Quicksand', sans-serif;
            font-size: 15px;
        }
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
        }
        h2 {
            font-weight: 700;
            font-size: 30px;
            color: #6a4029;
            margin-bottom: 30px;
            text-align: center;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            padding: 30px;
            background: #fff;
        }
        .table thead {
            background-color: #f8e9d2;
        }
        .table th, .table td {
            font-size: 14px;
            vertical-align: middle;
            padding: 12px;
        }
        .badge-secondary { background-color: #bcbcbc; }
        .badge-warning { background-color: #ffc107; }
        .badge-success { background-color: #28a745; }
        .badge-dark { background-color: #343a40; }

        /* Custom pagination style */
        .pagination .page-item.active .page-link {
            background-color: #ffffff;
            border-color: #ffffff;
        }
        .pagination .page-link {
            color: #6a4029;
            border-radius: 8px;
            margin: 0 4px;
        }
    </style>
</head>
<body>

@include('pelanggan.sidebar')

<div class="container">
    <div class="card">
        <h2>Pesanan Saya</h2>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Metode</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanan as $index => $item)
                        <tr>
                            <td>{{ $pesanan->firstItem() + $index }}</td>
                            <td>{{ $item->nama_pemesan }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $status = strtolower($item->status_pesanan);
                                    $warna = match(true) {
                                        str_contains($status, 'belum') => 'secondary',
                                        str_contains($status, 'sedang') => 'warning',
                                        str_contains($status, 'selesai') => 'success',
                                        default => 'dark',
                                    };
                                @endphp
                                <span class="badge bg-{{ $warna }} px-3 py-2">{{ ucfirst($item->status_pesanan) }}</span>
                            </td>
                            <td>{{ strtoupper($item->metode_pembayaran) }}</td>
                            <td>{{ $item->created_at ? $item->created_at->format('d M Y H:i') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Estetik pagination -->
        <div class="d-flex justify-content-center">
            {{ $pesanan->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>

@include('layouts.footer')

</body>
</html>
