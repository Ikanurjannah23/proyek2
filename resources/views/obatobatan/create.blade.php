<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Obat</title>
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
                <h3 class="text-center">Tambah Obat</h3>

                <form action="{{ route('obatobatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis</label>
                            <select name="jenis" class="form-control" required>
                                <option value="" disabled selected>Pilih Jenis</option>
                                <option value="Aksesori">Aksesori</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Perlengkapan">Perlengkapan</option>
                                <option value="Obat-obatan">Obat-obatan</option>
                                <option value="Vitamin Kucing">Vitamin Kucing</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jumlah Stok</label>
                            <input type="number" name="jumlah_stok" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <button type="submit">Simpan</button>
                    <a href="{{ route('obatobatan.index') }}" class="cancel-link">← Batal</a>
                </form>
            </div>

            <div class="image-section">
                <img src="{{ asset('images/kucing.png') }}" alt="Gambar Obat">
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
