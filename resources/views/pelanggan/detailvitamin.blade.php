<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $item->nama_produk }} | Khakiel PetShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #fdf6ec;
            font-family: 'Poppins', sans-serif;
        }

        .product-container {
            background-color: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .product-img {
            width: 100%;
            border-radius: 16px;
            object-fit: cover;
        }

        .product-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 22px;
            color: #ee4d2d;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .badge-info {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
        }

        .btn-shop {
            background-color: #3cb4ac;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 10px;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-shop:hover {
            background-color: #2da097;
        }

        .btn-add-cart {
            background-color: #fff;
            border: 2px solid #3cb4ac;
            color: #3cb4ac;
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-add-cart:hover {
            background-color: #e0f4f3;
        }

        .back-link {
            color: #3cb4ac;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            display: inline-block;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .product-description {
            margin-top: 30px;
            font-size: 15px;
            line-height: 1.6;
            color: #333;
        }

        .related-img {
            width: 100px;
            margin-top: 30px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

{{-- Navbar --}}
@include('pelanggan.sidebar')

<div class="container py-5">
    <a href="{{ route('kebutuhanvitamin') }}" class="back-link">&larr; Kembali ke Daftar Vitamin</a>

    <div class="row product-container">
        <div class="col-md-5 mb-4 mb-md-0">
            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="product-img">
        </div>
        <div class="col-md-7">
            <h1 class="product-title">{{ $item->nama_produk }}</h1>
            <p class="badge-info">
                Jenis: <strong>{{ $item->jenis_produk }}</strong> |
                Kategori: Vitamin Kucing
            </p>
            <p class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>

            <div class="d-flex gap-3 mb-3 flex-wrap">
                <a href="{{ route('formpesanan.show', ['jenis' => 'vitaminkucing', 'id' => $VitaminKucing->id]) }}" class="btn-shop"><i class="bi bi-cart-check"></i> Pesan Sekarang</a>
                <button class="btn-add-cart"><i class="bi bi-plus-circle"></i> Tambah ke Keranjang</button>
            </div>

            <p class="text-muted mt-3">Stok tersedia: <strong>{{ $item->stok }}</strong></p>

            <div class="product-description">
                <h5><strong>Deskripsi Produk</strong></h5>
                <p>{!! nl2br(e($item->deskripsi)) !!}</p>
            </div>

            <div class="text-end">
                <img src="{{ asset('images/kucing.png') }}" alt="Vitamin Terkait" class="related-img">
            </div>
        </div>
    </div>
</div>

{{-- Footer --}}
@include('layouts.footer')

</body>
</html>
