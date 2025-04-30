<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Keranjang Pesanan</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts -->
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
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 12px;
            vertical-align: middle;
        }
        .table th {
            background: #a7a8a9;
            color: white;
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
    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    <div class="container page-content">
        <div class="card">
            <h2 class="text-center mb-4 fw-bold text-uppercase text-dark">Kelola Keranjang Pesanan</h2>

            <div class="search-bar">
                <div>
                    <a href="{{ route('kelolakeranjangpesanan.create') }}" class="btn btn-success">+ Tambah Keranjang</a>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Akun atau Produk..." style="border-right: none;">
                        <span class="input-group-text bg-white" style="border-left: none;">
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
                <table class="table table-hover text-center" id="keranjangTable">
                    <thead>
                        <tr>
                            <th>ID Keranjang</th>
                            <th>Nama Akun Pembeli</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keranjangPesanans as $k)
                        <tr>
                            <td>{{ $k->id }}</td>
                            <td>{{ $k->user->nama ?? '-' }}</td>
                            <td>{{ $k->produk->nama ?? '-' }}</td>
                            <td>{{ $k->jumlah }}</td>
                            <td>
                                <a href="{{ route('kelolakeranjangpesanan.edit', $k->id) }}" class="btn btn-sm btn-edit">Edit</a>
                                <form action="{{ route('kelolakeranjangpesanan.destroy', $k->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-hapus" onclick="return confirm('Yakin ingin menghapus keranjang ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="notFoundMessage" class="text-center fw-bold text-danger mt-3" style="display: none;">
                    Tidak ditemukan.
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

    <script>
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#keranjangTable tbody tr');
        const notFoundMessage = document.getElementById('notFoundMessage');

        searchInput.addEventListener('keyup', function() {
            const searchText = searchInput.value.toLowerCase();
            let found = false;

            tableRows.forEach(function(row) {
                const namaUser = row.cells[1].textContent.toLowerCase();
                const namaProduk = row.cells[2].textContent.toLowerCase();
                if (namaUser.includes(searchText) || namaProduk.includes(searchText)) {
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
