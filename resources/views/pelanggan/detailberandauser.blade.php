<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artikel->judul }} | Khakiel PetShop</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fcf5ea;
            margin: 0;
            padding: 0;
        }
        .artikel-container {
            background-color: #fff3dd;
            border-radius: 10px;
            padding: 30px;
            margin: 40px auto;
            max-width: 1000px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            display: flex;
            gap: 30px;
            align-items: flex-start;
            position: relative;
            flex-wrap: wrap;
        }
        .artikel-gambar {
            width: 250px;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }
        .artikel-isi {
            flex: 1;
        }
        .artikel-isi h3 {
            font-weight: 700;
            font-size: 20px;
        }
        .artikel-isi p, .artikel-isi li {
            font-size: 14px;
            line-height: 1.7;
        }
        .produk-gambar {
            width: 120px;
            margin-top: 20px;
        }
        .btn-kembali {
            background-color: #343a40;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin: 30px auto 0;
        }
        .btn-kembali:hover {
            background-color: #212529;
        }

        @media (max-width: 768px) {
            .artikel-container {
                flex-direction: column;
                align-items: center;
            }
            .artikel-gambar {
                width: 100%;
                max-width: 400px;
            }
            .produk-gambar {
                width: 100px;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('pelanggan.sidebar')

    <div class="artikel-container">
        {{-- Gambar utama artikel --}}
        <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="Gambar Artikel" class="artikel-gambar">

        {{-- Isi artikel --}}
        <div class="artikel-isi">
            <h3>{{ $artikel->judul }}</h3>
            <p class="text-muted">{{ \Carbon\Carbon::parse($artikel->tanggal)->translatedFormat('d F Y') }}</p>
            <p>{!! nl2br(e($artikel->isi_artikel)) !!}</p>

            {{-- Gambar produk diletakkan di bawah isi --}}
            <div class="text-end">
                <img src="{{ asset('images/kucing.png') }}" alt="Produk Terkait" class="produk-gambar">
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('berandauser') }}" class="btn-kembali">← Kembali ke Beranda</a>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
