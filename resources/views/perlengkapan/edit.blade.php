<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Perlengkapan</title>
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

    @include('layouts.navbar')

    <div class="container-wrapper">
        <div class="custom-card">
            <div class="form-section">
                <h3 class="text-center">Edit Perlengkapan</h3>

                <form action="{{ route('perlengkapan.update', $perlengkapan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $perlengkapan->nama }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis</label>
                            <input type="text" name="jenis" class="form-control" value="{{ $perlengkapan->jenis }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jumlah Stok</label>
                            <input type="number" name="jumlah_stok" class="form-control" value="{{ $perlengkapan->jumlah_stok }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Harga</label>
                            <input type="text" name="harga" class="form-control" value="{{ $perlengkapan->harga }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ $perlengkapan->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload Gambar Baru</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <button type="submit">Simpan Perubahan</button>
                    <a href="{{ route('perlengkapan.index') }}" class="cancel-link">← Batal</a>
                </form>
            </div>

            <div class="image-section">
                @if ($perlengkapan->gambar)
                    <img src="{{ asset('images/kucing.png') }}" alt="Gambar Perlengkapan">
                @else
                    <p class="text-muted">Belum ada gambar.</p>
                @endif
            </div>
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>
