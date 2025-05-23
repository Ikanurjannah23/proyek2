<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun</title>

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
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            background: #E5CBB7;
            border: none;
            padding: 30px;
        }

        .table {
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
            text-transform: uppercase;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
            transition: 0.3s;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: 0.3s ease-in-out;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-hapus {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-hapus:hover {
            background-color: #c82333;
        }

        .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        #notFoundMessage {
            display: none;
        }

        .btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    <div class="container page-content">
        <div class="card">
            <h2 class="text-center mb-4 fw-bold text-uppercase text-dark">Kelola Akun</h2>

            <div class="search-bar">
                <a href="{{ route('kelola_akun.create') }}" class="btn btn-success">
                    <i class="fas fa-user-plus"></i> Tambah Akun
                </a>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Akun..." style="border-right: none;">
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
                <table class="table table-hover text-center" id="akunTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($akuns as $a)
                        <tr>
                            <td>{{ $a->id }}</td>
                            <td>{{ $a->nama }}</td>
                            <td>{{ $a->email }}</td>
                            <td>{{ $a->role }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('kelola_akun.edit', $a->id) }}" class="btn btn-sm btn-edit d-flex align-items-center">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('kelola_akun.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-hapus d-flex align-items-center">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="notFoundMessage" class="text-center fw-bold text-danger mt-3">
                    Tidak ditemukan.
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

    <script>
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#akunTable tbody tr');
        const notFoundMessage = document.getElementById('notFoundMessage');

        searchInput.addEventListener('keyup', function () {
            const searchText = searchInput.value.toLowerCase();
            let found = false;

            tableRows.forEach(function (row) {
                const namaAkun = row.cells[1].textContent.toLowerCase();
                if (namaAkun.includes(searchText)) {
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
