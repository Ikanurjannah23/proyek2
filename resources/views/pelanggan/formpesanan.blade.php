<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan | Khakiel PetShop</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #fdf6ec;
            font-family: 'Poppins', sans-serif;
        }
        .order-container {
            background-color: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        .product-img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 12px;
        }
        .btn-order {
            background-color: #3cb4ac;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .btn-order:hover {
            background-color: #2da097;
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
        label {
            font-weight: 500;
        }
    </style>
</head>
<body>

@include('pelanggan.sidebar')

<div class="container py-5">
    <a href="{{ route('makanankucing') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali</a>

    <div class="row order-container">
        <div class="col-md-5 mb-4">
            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="product-img">
            <h4 class="mt-3">{{ $produk->nama_produk }}</h4>
            <p>Harga: <strong>Rp {{ number_format($produk->harga, 0, ',', '.') }}</strong></p>
            <p><strong>Qty:</strong> <span id="qty-display">1</span></p>
            <p><strong>Total:</strong> Rp <span id="total-harga">{{ number_format($produk->harga, 0, ',', '.') }}</span></p>
        </div>

        <div class="col-md-7">
            <h4 class="mb-4">Form Pemesanan</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('formpesanan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <input type="hidden" name="jenis" value="{{ $jenis }}">

                <div class="mb-3">
                    <label for="nama_pemesan">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="2" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="no_telepon">No Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" class="form-control" required pattern="[0-9]{10,15}" title="Masukkan nomor telepon yang valid (10-15 digit)">
                </div>

                <div class="mb-3">
                    <label for="qty">Jumlah</label>
                    <input type="number" name="qty" id="qty" class="form-control" value="1" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="metode_pembayaran">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="COD">COD</option>
                        <option value="Dana">E-Wallet</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_pesan">Tanggal Pemesanan</label>
                    <input type="date" name="tanggal_pesan" id="tanggal_pesan" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-order w-100">Pesan Sekarang</button>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
    const qtyInput = document.getElementById('qty');
    const qtyDisplay = document.getElementById('qty-display');
    const totalHarga = document.getElementById('total-harga');
    const hargaSatuan = {{ $produk->harga }};

    qtyInput.addEventListener('input', function () {
        const qty = parseInt(this.value) || 1;
        qtyDisplay.textContent = qty;
        const total = qty * hargaSatuan;
        totalHarga.textContent = total.toLocaleString('id-ID');
    });
</script>

</body>
</html>
