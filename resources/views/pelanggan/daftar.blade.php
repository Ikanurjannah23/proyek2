<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar - Khakiel Petshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fdfaf3;
            color: #333;
        }
        .register-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 40px 15px;
        }
        .register-card {
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
        .form-area {
            flex: 1;
        }
        .form-area h2 {
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-control {
            border-radius: 20px;
            padding: 12px;
            font-size: 16px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 159, 67, 0.25);
            border-color: #ff9f43;
        }
        .btn-register {
            background: #000;
            color: white;
            border-radius: 30px;
            padding: 12px;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-register:hover {
            background: #a5a5a5;
        }
        .image-area {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .image-area img {
            max-width: 100%;
            border-radius: 20px;
            border: 1px solid #ccc;
        }
        @media (max-width: 768px) {
            .register-card {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="register-card">
            <div class="form-area">
                <h2>Daftar</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('pelanggan.daftar.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Sandi</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-register">Daftar</button>
                </form>

                <div class="text-center mt-3">
                    Sudah punya akun? <a href="{{ url('/login') }}">Masuk</a>
                </div>
            </div>

            <div class="image-area">
                <img src="{{ asset('images/kucing.png') }}" alt="Ilustrasi Daftar">
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>
