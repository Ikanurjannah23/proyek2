<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fdfaf3;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .container-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 15px;
        }
        .custom-card {
            background: #E5CBB7;
            border-radius: 25px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            display: flex;
            flex-direction: row;
            gap: 40px;
            max-width: 1000px;
            width: 100%;
        }
        .form-section {
            flex: 1;
        }
        .image-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .image-section img {
            max-width: 100%;
            border-radius: 20px;
        }
        .form-control, select {
            border-radius: 20px;
            border: 1px solid #ccc;
            padding: 12px;
            font-size: 16px;
        }
        .form-control:focus, select:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 159, 67, 0.25);
            border-color: #ff9f43;
        }
        select {
            cursor: pointer;
            background-color: #fff;
        }
        button {
            background: #000000;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 30px;
            width: 100%;
            transition: all 0.3s;
        }
        button:hover {
            background: #a5a5a5;
        }
        h3 {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .text-danger {
            font-size: 14px;
        }
        @media (max-width: 768px) {
            .custom-card {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    <div class="container-wrapper">
        <div class="custom-card">
            <div class="form-section">
                <h3 class="text-center">Edit Status Pemesanan</h3>

                {{-- Pesan Error Validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kelolastatuspesanan.update', $kelolastatuspesanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Pemesan</label>
                        <input type="text" name="nama_pemesan" class="form-control" value="{{ old('nama_pemesan', $kelolastatuspesanan->nama_pemesan) }}">
                        @error('nama_pemesan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk', $kelolastatuspesanan->nama_produk) }}">
                        @error('nama_produk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status Pemesanan</label>
                        <select name="status_pesanan" class="form-control">
                            <option value="belum diproses" {{ old('status_pesanan', $kelolastatuspesanan->status_pesanan) == 'belum diproses' ? 'selected' : '' }}>Belum Diproses</option>
                            <option value="sedang diproses" {{ old('status_pesanan', $kelolastatuspesanan->status_pesanan) == 'sedang diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="selesai" {{ old('status_pesanan', $kelolastatuspesanan->status_pesanan) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status_pesanan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Qty</label>
                        <input type="number" name="qty" class="form-control" value="{{ old('qty', $kelolastatuspesanan->qty) }}">
                        @error('qty')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-control">
                            <option value="ewallet" {{ old('metode_pembayaran', $kelolastatuspesanan->metode_pembayaran) == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="COD" {{ old('metode_pembayaran', $kelolastatuspesanan->metode_pembayaran) == 'COD' ? 'selected' : '' }}>COD</option>
                        </select>
                        @error('metode_pembayaran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga</label>
                        <input type="number" name="harga" class="form-control" value="{{ old('harga', $kelolastatuspesanan->harga) }}">
                        @error('harga')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit">Simpan</button>
                </form>
            </div>

            <div class="image-section">
                <img src="{{ asset('images/kucing.png') }}" alt="Gambar Pemesanan">
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
