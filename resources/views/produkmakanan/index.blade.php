<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk Makanan</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome (buat icon paw) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Poppins font -->
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
            animation: fadeIn 0.6s ease-in-out;
        }
        .table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            animation: fadeIn 0.6s ease-in-out;
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
        .table tbody tr:hover {
            background: rgba(0, 0, 0, 0.03);
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
        .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .input-group .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .input-group .input-group-text {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            background: white;
            border: none;
        }
    </style>
</head>
<body>

    {{-- Include Navbar --}}
    @include('layouts.navbar')

    <div class="container page-content">
        <div class="card">
            <h2 class="text-center mb-4 fw-bold text-uppercase text-dark">Data Produk Makanan</h2>

            <div class="search-bar">
                <a href="{{ route('produkmakanan.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Produk...">
                        <span class="input-group-text">
                            <i class="fas fa-paw"></i>
                        </span>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover text-center" id="produkTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Jenis Produk</th>
                            <th>Jumlah Stok</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produks as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->nama_produk }}</td>
                            <td>{{ $p->jenis_produk }}</td>
                            <td>{{ $p->jumlah_stok }}</td>
                            <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>{{ $p->deskripsi }}</td>
                            <td>
                                @if($p->gambar)
                                    <img src="{{ asset('storage/'.$p->gambar) }}" alt="Gambar Produk" width="60" class="rounded">
                                @else
                                    <small>Tidak ada</small>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('produkmakanan.edit', $p->id) }}" class="btn btn-sm btn-edit d-flex align-items-center">
                                        <i class="fas fa-pen me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('produkmakanan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-hapus d-flex align-items-center">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Kalau tidak ditemukan --}}
                <div id="notFoundMessage" class="text-center fw-bold text-danger mt-3" style="display: none;">
                    Tidak ditemukan.
                </div>
            </div>
        </div>
    </div>

    {{-- Include Footer --}}
    @include('layouts.footer')

    <script>
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#produkTable tbody tr');
        const notFoundMessage = document.getElementById('notFoundMessage');

        searchInput.addEventListener('keyup', function () {
            const searchText = searchInput.value.toLowerCase();
            let found = false;

            tableRows.forEach(function (row) {
                const namaProduk = row.cells[1].textContent.toLowerCase();
                if (namaProduk.includes(searchText)) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            notFoundMessage.style.display = found ? 'none' : 'block';
        });
    </script>

</body>
</html>
