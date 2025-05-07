<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kebutuhan Obat | Khakiel PetShop</title>
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

        .card img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .card-body {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-body h5 {
            font-size: 16px;
            font-weight: bold;
        }

        .card-body p {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .price {
            color: #3cb4ac;
            font-weight: 600;
        }

        .btn-detail {
            margin-top: auto;
            font-size: 13px;
            background-color: #3cb4ac;
            color: white;
            border-radius: 10px;
            padding: 6px 10px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn-detail:hover {
            background-color: #2da097;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    @include('pelanggan.sidebar')

    <div class="main-content">
        <h2 class="title">Kebutuhan Obat</h2>
        <div class="card-container">
            @foreach($obat as $item)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                        <div class="card-body">
                            <h5>{{ $item->nama }}</h5>
                            <p>{{ Str::limit($item->deskripsi, 80) }}</p>
                            <p class="price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            <p class="text-muted">Stok: {{ $item->jumlah_stok }}</p>
                            <a href="{{ route('kebutuhanobat.show', $item->id) }}" class="btn-detail mt-2">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>
