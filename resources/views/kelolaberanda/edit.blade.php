<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            font-family: 'Poppins', sans-serif;
        }
        .container {
            padding-top: 100px;
            padding-bottom: 50px;
        }
        .card {
            border-radius: 15px;
            background-color: #E5CBB7;
            padding: 30px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: 500;
        }
        .btn-primary {
            background-color: #ffc107;
            color: #000;
            border: none;
        }
        .btn-primary:hover {
            background-color: #e0a800;
        }
        .form-control, .form-control-file {
            border-radius: 10px;
        }
        .img-thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center mb-4 fw-bold">Edit Artikel</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kelolaberanda.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul', $artikel->judul) }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', $artikel->tanggal) }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat</label>
                <textarea id="deskripsi_singkat" name="deskripsi_singkat" class="form-control" required>{{ old('deskripsi_singkat', $artikel->deskripsi_singkat) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="isi_artikel" class="form-label">Isi Artikel</label>
                <textarea id="isi_artikel" name="isi_artikel" class="form-control" required>{{ old('isi_artikel', $artikel->isi_artikel) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar (Opsional)</label>
                <input type="file" id="gambar" name="gambar" class="form-control-file">
                @if($artikel->gambar)
                    <div class="mt-2">
                        <p><strong>Gambar Saat Ini:</strong></p>
                        <img src="{{ asset('storage/'.$artikel->gambar) }}" class="img-thumbnail" alt="Gambar Artikel">
                    </div>
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Perbarui Artikel</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
