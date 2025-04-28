<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Khakiel Petshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fdfaf3;
            color: #333;
        }
        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 40px 15px;
        }
        .login-card {
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
        .btn-login {
            background: #000;
            color: white;
            border-radius: 30px;
            padding: 12px;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-login:hover {
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
        footer {
            text-align: center;
            padding: 20px;
            background-color: #E5CBB7;
            font-size: 14px;
        }
        .logo {
            font-weight: bold;
            font-size: 18px;
        }
        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="form-area">
                <h2 class="text-center">Masuk</h2>

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Sandi</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-login">Masuk</button>
                </form>
            </div>

            <div class="image-area">
                <img src="{{ asset('images/kucing.png') }}" alt="Ilustrasi Login">
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>
