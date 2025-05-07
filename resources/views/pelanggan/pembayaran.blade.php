<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | Khakiel PetShop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 50px;
        }

        h4 {
            color: #333;
            font-weight: 600;
        }

        .btn-success {
            background-color: #3cb4ac;
            border: none;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 8px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #2da097;
        }

        .alert {
            font-size: 14px;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #e0f7e6;
            border-color: #3cb4ac;
            color: #3cb4ac;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }

        .payment-summary {
            margin-top: 30px;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 8px;
            text-align: center;
        }

        .payment-summary p {
            font-size: 18px;
            margin: 10px 0;
        }

        .payment-summary strong {
            color: #333;
        }

        @media (max-width: 576px) {
            .container {
                padding: 30px;
                margin-top: 30px;
            }

            h4 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

@include('pelanggan.sidebar')

<div class="container py-5">
    <h4 class="mb-4">Pembayaran</h4>
    <div class="payment-summary">
        <p><strong>Produk:</strong> Nama Produk</p>
        <p><strong>Total Pembayaran:</strong> Rp 200.000</p>
    </div>
    <button id="pay-button" class="btn btn-success w-100">Bayar Sekarang</button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    const payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert('Pembayaran berhasil!');
                window.location.href = "{{ route('berandauser') }}";
            },
            onPending: function(result) {
                alert('Pembayaran sedang diproses.');
            },
            onError: function(result) {
                alert('Pembayaran gagal.');
            }
        });
    });
</script>

@include('layouts.footer')

</body>
</html>
