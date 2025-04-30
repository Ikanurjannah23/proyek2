<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>

    <style>
        /* Global Style */
        body {
            background-color: #f9f5eb;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Untuk memberi ruang di bawah navbar */
        main {
            padding-top: 100px; /* Kasih jarak supaya konten tidak ketimpa navbar */
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: calc(100vh - 100px);
        }

        /* Container Utama */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 50px;
            margin-bottom: 40px;
        }

        .top-container, .bottom-container {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
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
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #000;
            transition: 0.3s;
        }

        .box:hover {
            background-color: #d3b9a3;
            transform: translateY(-5px);
        }

        .box i, .box svg {
            font-size: 30px;
            margin-bottom: 10px;
        }

        /* Alert Sukses */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 600px;
            text-align: center;
            font-size: 16px;
            font-weight: 500;
        }
    </style>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Konten Utama -->
    <main>

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Kotak Navigasi -->
        <div class="container">

            <!-- Top Buttons -->
            <div class="top-container">
                <a href="{{ route('kelola_akun.index') }}" class="box">
                    <i class="fas fa-user"></i>
                    Kelola Akun Pembeli
                </a>

                <a href="{{ route('kelolastatuspesanan.index') }}" class="box" class="{{ request()->routeIs('kelolastatuspesanan*') ? 'active' : '' }}">
                    <i class="fas fa-exchange-alt"></i>
                    Kelola Status Pesanan
                </a>
            </div>

            <!-- Bottom Buttons -->
            <div class="bottom-container">
                <a href="{{ route('kelola.produk') }}" class="box">
                    <i class="fas fa-box"></i>
                    Kelola Produk
                </a>

                <div class="box">
                    <i class="fas fa-shopping-cart"></i>
                    Kelola Keranjang Pesanan
                </div>

                <div class="box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-clipboard2-fill" viewBox="0 0 16 16">
                        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                        <path d="M3.5 1h.585A1.5 1.5 0 0 0 4 1.5V2a1.5 1.5 0 0 0 1.5 1.5h5A1.5 1.5 0 0 0 12 2v-.5q-.001-.264-.085-.5h.585A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1"/>
                    </svg> 
                    <a href="{{ route('laporan_penjualan') }}"> Kelola Laporan Penjualan
                </div>
            </div>

        </div>

    </main>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
