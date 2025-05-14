<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Status Pesanan</title>

    <!-- Bootstrap & Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-radius: 10px;
        }

        .table th, .table td {
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
            transform: scale(1.01);
            transition: all 0.3s ease-in-out;
        }

        .badge {
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 50px;
            font-weight: 500;
        }

        .badge-proses  { background: #ffc107; color: #333; }
        .badge-selesai { background: #28a745; color: white; }
        .badge-belum   { background: #6c757d; color: white; }
        .badge-batal   { background: #dc3545; color: white; }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
            white-space: nowrap;
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
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    <div class="container page-content">
        <div class="card">
            <h2 class="text-center mb-4 fw-bold text-uppercase text-dark">Kelola Pesanan</h2>
            <div class="table-responsive">
                <table class="table table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pemesan</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Nama Produk</th>
                            <th>Tanggal Pesanan</th>
                            <th>Status</th>
                            <th>Qty</th>
                            <th>Jumlah</th>
                            <th>Metode Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statusPesanan as $status)
                        <tr>
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->nama_pemesan }}</td>
                            <td>{{ $status->alamat ?? '-' }}</td>
                            <td>{{ $status->no_telepon }}</td>
                            <td>{{ $status->nama_produk }}</td>
                            <td>{{ $status->tanggal_pesanan ? \Carbon\Carbon::parse($status->tanggal_pesanan)->translatedFormat('d F Y') : '-' }}</td>
                            <td>
                                @php
                                    $badgeClass = match($status->status_pesanan) {
                                        'sedang diproses' => 'badge-proses',
                                        'selesai' => 'badge-selesai',
                                        'belum diproses' => 'badge-belum',
                                        'pesanan dibatalkan' => 'badge-batal',
                                        default => 'badge-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($status->status_pesanan) }}</span>
                            </td>
                            <td>{{ $status->qty }}</td>
                            <td>
                                @if($status->qty > 0)
                                    Rp {{ number_format($status->harga * $status->qty, 0, ',', '.') }}
                                @else
                                    Rp 0
                                @endif
                            </td>
                            <td>{{ ucfirst($status->metode_pembayaran) }}</td>
                            <td>
                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                    <a href="{{ route('kelolastatuspesanan.edit', $status->id) }}" class="btn btn-sm btn-edit">
                                        ✏️ Edit
                                    </a>

                                    @php
                                        $pesan = "Hai *{$status->nama_pemesan}*,%0APesanan Anda untuk *{$status->nama_produk}* sebanyak *{$status->qty} pcs* telah kami terima.%0ATotal: *Rp" . number_format($status->harga * $status->qty, 0, ',', '.') . "*%0AStatus: *Menunggu Konfirmasi*.%0A%0ATerima kasih telah berbelanja di toko kami! 🐾";
                                    @endphp

                                    <button class="btn btn-sm btn-success kirim-wa"
                                        data-nomor="{{ $status->no_telepon }}"
                                        data-pesan="{{ $pesan }}">
                                        ✅ Kirim WA
                                    </button>

                                    <form action="{{ route('kelolastatuspesanan.destroy', $status->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-hapus">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.kirim-wa').on('click', function () {
                const nomor = $(this).data('nomor');
                const pesan = $(this).data('pesan');

                $.ajax({
                    url: '{{ route("kelolastatuspesanan.kirimwa") }}',
                    method: 'POST',
                    data: {
                        no_telepon: nomor,
                        pesan: decodeURIComponent(pesan),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        toastr.success(response.message);
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON?.error || 'Gagal mengirim pesan.');
                    }
                });
            });
        });
    </script>

</body>
</html>
