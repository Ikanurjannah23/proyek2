<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Obat-obatan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Bootstrap & Google Fonts --}}
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
            vertical-align: middle;
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

        .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .input-group-text {
            background: white;
            border: none;
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

    {{-- Navbar --}}
    @include('layouts.navbar')

    <div class="container page-content">
        <div class="card">
            <h2 class="text-center mb-4 fw-bold text-uppercase text-dark">Kelola Obat-obatan</h2>

            <div class="search-bar">
                <div>
                    <a href="{{ route('obatobatan.create') }}" class="btn btn-success">+ Tambah Obat</a>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Obat..." style="border-right: none;">
                        <span class="input-group-text bg-white" style="border-left: none;">
                            <i class="fas fa-paw"></i> {{-- icon paw --}}
                        </span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover text-center" id="obatTable">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                        @foreach($data as $obat)
                        <tr>
                            <td>{{ $obat->id }}</td>
                            <td>{{ $obat->nama }}</td>
                            <td>{{ $obat->jenis }}</td>
                            <td>{{ $obat->jumlah_stok }}</td>
                            <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                            <td>{{ $obat->deskripsi }}</td>
                            <td>
                                @if($obat->gambar)
                                    <img src="{{ asset('storage/'.$obat->gambar) }}" width="60" class="rounded">
                                @else
                                    <small>Tidak ada</small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('obatobatan.edit', $obat->id) }}" class="btn btn-sm btn-edit">Edit</a>
                                <form action="{{ route('obatobatan.destroy', $obat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-hapus">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- If no results are found --}}
                <div id="notFoundMessage" class="text-center fw-bold text-danger mt-3" style="display: none;">
                    Tidak ditemukan.
                </div>

            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Search functionality --}}
    <script>
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#obatTable tbody tr');
        const notFoundMessage = document.getElementById('notFoundMessage');

        searchInput.addEventListener('keyup', function() {
            const searchText = searchInput.value.toLowerCase();
            let found = false;

            tableRows.forEach(function(row) {
                const namaObat = row.cells[1].textContent.toLowerCase();
                if (namaObat.includes(searchText)) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            if (!found) {
                notFoundMessage.style.display = 'block';
            } else {
                notFoundMessage.style.display = 'none';
            }
        });
    </script>

</body>
</html>
