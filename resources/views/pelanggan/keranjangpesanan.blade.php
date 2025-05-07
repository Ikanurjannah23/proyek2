<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Pesanan | Khakiel PetShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fdf6ec;
            font-family: 'Poppins', sans-serif;
        }

        .main-content {
            padding: 40px 20px;
        }

        .title {
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            justify-content: center;
        }

        .col-md-3 {
            flex: 0 0 22%;
            max-width: 22%;
        }

        .card {
            background: #fff8f0;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .card-body h5 {
            font-size: 16px;
            font-weight: bold;
        }

        .price {
            color: #3cb4ac;
            font-weight: 600;
        }

        .btn-hapus {
            margin-top: auto;
            font-size: 13px;
            background-color: #dc3545;
            color: white;
            border-radius: 10px;
            padding: 6px 10px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn-hapus:hover {
            background-color: #c82333;
        }

        .text-muted {
            font-size: 13px;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    @include('pelanggan.sidebar')

    <div class="main-content">
        <h2 class="title">Keranjang Pesanan</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if($pesanan->isEmpty())
            <p class="text-center">Belum ada pesanan di keranjang.</p>
        @else
            <div class="card-container">
                @foreach($pesanan as $item)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>{{ $item->nama_produk }}</h5>
                                <p class="text-muted">Qty: {{ $item->qty }}</p>
                                <p class="price">Total: Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                <p class="text-muted">Pembayaran: {{ $item->metode_pembayaran }}</p>
                                <p class="text-muted">Status: {{ $item->status_pesanan }}</p>
                                <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @include('layouts.footer')

</body>
</html>
