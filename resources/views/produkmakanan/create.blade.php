<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
            border: 1px solid #ccc;
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
        .cancel-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #555;
            font-size: 14px;
            text-decoration: none;
        }
        .cancel-link:hover {
            text-decoration: underline;
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
                <h3 class="text-center">Tambah Produk</h3>

                {{-- Pesan Error Global --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan!</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('produkmakanan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control @error('nama') is-invalid @enderror" required>
                            @error('nama')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis Produk</label>
                            <select name="jenis_produk" class="form-control @error('jenis') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Jenis</option>
                                <option value="Aksesori">Aksesori</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Perlengkapan">Perlengkapan</option>
                                <option value="Obat-obatan">Obat-obatan</option>
                                <option value="Vitamin Kucing">Vitamin Kucing</option>
                            </select>
                            @error('jenis')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jumlah Stok</label>
                            <input type="number" name="jumlah_stok" min="0" class="form-control @error('stok') is-invalid @enderror" required>
                            @error('stok')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Harga</label>
                            <input type="number" name="harga" min="1" class="form-control @error('harga') is-invalid @enderror" required>
                            @error('harga')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" required></textarea>
                        @error('deskripsi')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Unggah Foto Produk</label>
                        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*" required>
                        @error('gambar')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit">Simpan</button>
                    <a href="{{ route('produkmakanan.index') }}" class="cancel-link">← Batal</a>
                </form>
            </div>

            <div class="image-section">
                <img src="{{ asset('images/kucing.png') }}" alt="Gambar Produk">
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
