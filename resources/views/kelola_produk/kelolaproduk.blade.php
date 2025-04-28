<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk</title>

    <style>
        /* Global Style */
        body {
            background-color: #f9f5eb;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Container Utama */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 85vh;
            margin-top: 20px;
        }

        .top-container, .bottom-container {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 40px;
        }

        /* Box Navigasi */
        .box {
            width: 220px;
            height: 200px;
            background-color: #E5CBB7;
            border-radius: 10px;
            box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none; /* Biar gak kelihatan link */
            color: #000; /* Warna teks hitam */
        }

        .box:hover {
            transform: scale(1.05);
            box-shadow: 4px 6px 12px rgba(0, 0, 0, 0.3);
            color: #000; /* Saat hover tetap hitam */
        }

        /* Ikon dalam Box */
        .box i {
            font-size: 30px;
            margin-bottom: 10px;
        }
    </style>

    <!-- Font Awesome untuk ikon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Konten -->
    <div class="container">

        <!-- Baris atas -->
        <div class="top-container">
            <a href="{{ route('produkmakanan.index') }}" class="box">
                <i class="fas fa-utensils"></i>
                Makanan Kucing
            </a>
            <a href="{{ route('aksesoris.index') }}" class="box">
                <i class="fas fa-paw"></i>
                Aksesoris
            </a>
        </div>

        <!-- Baris bawah -->
        <div class="bottom-container">
            <a href="{{ route('obatobatan.index') }}" class="box">
                <i class="fas fa-pills"></i>
                Obat-obatan
            </a>
            <a href="{{ route('perlengkapan.index') }}" class="box">
                <i class="fas fa-tshirt"></i>
                Perlengkapan
            </a>
            <a href="{{ route('vitaminkucing.index') }}" class="box">
                <i class="fas fa-prescription-bottle-alt"></i>
                Vitamin Kucing
            </a>
        </div>

    </div>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
