<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Aksesoris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .page-content {
            padding-top: 160px;
            padding-bottom: 50px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            background: #E5CBB7;
            border: none;
            padding: 20px;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
        }

        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 12px;
        }

        .table th {
            background: #a7a8a9;
            color: white;
            font-weight: 600;
        }

        .table tbody tr {
            transition: all 0.3s ease-in-out;
        }

        .table tbody tr:hover {
            background: rgba(0, 0, 0, 0.03);
            transform: scale(1.01);
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
        }

        .btn-edit {
            background: #ffc107;
            color: #333;
            border: none;
        }

        .btn-edit:hover {
            background: #e0a800;
        }

        .btn-hapus {
            background: #dc3545;
            color: white;
            border: none;
        }

        .btn-hapus:hover {
            background: #c82333;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card, .table {
            animation: fadeIn 0.6s ease-in-out;
        }
    </style>
</head>
<body>

    {{-- Include Navbar --}}
    @include('layouts.navbar')

    <div class="container page-content">
        <div class="card">
            <h2 class="text-center mb-4 fw-bold text-uppercase text-dark">Kelola Aksesoris</h2>

            <div class="mb-3 text-end">
                <a href="{{ route('aksesoris.create') }}" class="btn btn-success">+ Tambah Aksesoris</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Jumlah Stok</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aksesoris as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->jumlah_stok }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" width="60" class="rounded">
                                @else
                                    <small>Tidak ada gambar</small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('aksesoris.edit', $item->id) }}" class="btn btn-sm btn-edit">Edit</a>
                                <form action="{{ route('aksesoris.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Include Footer --}}
    @include('layouts.footer')

</body>
</html>
