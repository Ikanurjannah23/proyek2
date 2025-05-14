<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .container-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            text-transform: uppercase;
            width: 100%;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            margin-top: 10px;
        }
        h2 {
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
        }
    </style>
</head>
<body>

    @include('pelanggan.sidebar')

    @php
        // Normalisasi metode pembayaran agar sesuai validasi backend
        $rawMetode = strtolower($data['metode_pembayaran']);
        if ($rawMetode === 'e-wallet' || $rawMetode === 'ewallet') {
            $metodePembayaran = 'ewallet';
        } elseif ($rawMetode === 'cod') {
            $metodePembayaran = 'COD';
        } else {
            $metodePembayaran = 'COD'; // default fallback
        }
    @endphp

    <div class="container-wrapper">
        <div class="container">
            <h2>Resume Pemesanan</h2>
            <p><strong>Nama:</strong> {{ $data['nama_pemesan'] }}</p>
            <p><strong>Alamat:</strong> {{ $data['alamat'] }}</p> <!-- ✅ Tambahan alamat -->
            <p><strong>No Telepon:</strong> {{ $data['no_telepon'] }}</p>
            <p><strong>Produk:</strong> {{ $data['nama_produk'] }}</p>
            <p><strong>Qty:</strong> {{ $data['qty'] }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($data['total'], 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $data['metode_pembayaran'] }}</p>

            <button id="pay-button" class="btn btn-success mt-3">Bayar Sekarang</button>
            <a href="{{ route('formpesanan.show', ['jenis' => $data['jenis'], 'id' => $data['produk_id']]) }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        const payButton = document.getElementById('pay-button');

        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    fetch("{{ route('simpan.pesanan') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            nama_pemesan: "{{ $data['nama_pemesan'] }}",
                            alamat: "{{ $data['alamat'] }}", // ✅ Tambahkan ini
                            no_telepon: "{{ $data['no_telepon'] }}",
                            nama_produk: "{{ $data['nama_produk'] }}",
                            qty: {{ $data['qty'] }},
                            total: {{ $data['total'] }},
                            metode_pembayaran: "{{ $metodePembayaran }}"
                        })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal menyimpan data.');
                        return response.json();
                    })
                    .then(data => {
                        alert('Pembayaran berhasil & data tersimpan!');
                        window.location.href = "{{ route('berandauser') }}";
                    })
                    .catch(error => {
                        alert('Pembayaran berhasil tapi gagal menyimpan data.');
                        console.error('Error:', error);
                    });
                },
                onPending: function(result) {
                    alert('Pembayaran sedang diproses. Mohon tunggu konfirmasi.');
                },
                onError: function(result) {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                    console.error('Midtrans error:', result);
                }
            });
        });
    </script>

    @include('layouts.footer')

</body>
</html>
