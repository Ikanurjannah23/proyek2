<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | Khakiel PetShop</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #fdf6ec;
            font-family: 'Poppins', sans-serif;
        }

        .main-content {
            margin-left: 250px; /* sesuaikan dengan lebar sidebar */
            padding: 60px 20px 40px;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }

        .title {
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 40px;
            color: #333;
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 16px 16px 0 0;
        }

        .card-body {
            padding: 15px;
            text-align: left;
        }

        .card-body h5 {
            font-size: 16px;
            font-weight: bold;
            color: #1f1f1f;
            min-height: 45px;
        }

        .card-body p {
            font-size: 13px;
            color: #4f4f4f;
            margin-bottom: 6px;
        }

        .card-body .text-muted {
            font-size: 11px;
            color: #888;
        }

        .btn-baca {
            display: inline-block;
            margin-top: 8px;
            background-color: #3cb4ac;
            color: white;
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-baca:hover {
            background-color: #2da097;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    @include('pelanggan.sidebar')

    {{-- Konten Utama --}}
    <div class="main-content">
   

        <div class="card-container">
            @isset($artikels)
                @foreach($artikels as $a)
                    <div class="col-md-3">
                        <div class="card">
                            <img src="{{ asset('storage/'.$a->gambar) }}" alt="Gambar Artikel">
                            <div class="card-body">
                                <h5>{{ Str::limit($a->judul, 30) }}</h5>
                                <p>{{ Str::limit($a->deskripsi_singkat, 80) }}</p>
                                <p class="text-muted">by Khakiel PetShop | {{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d F Y') }}</p>
                                <a href="{{ route('berandauser.show', $a->id) }}" class="btn-baca">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Tidak ada artikel untuk ditampilkan.</p>
            @endisset
        </div>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
