<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    {{-- Poppins font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .page-content {
            padding-top: 150px;
            padding-bottom: 50px;
        }
        .form-container {
            background-color: #E5CBB7;
            padding: 30px;
            border-radius: 20px;
            max-width: 900px;
            margin: auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
        }
        .form-box {
            flex: 1 1 400px;
            padding: 20px;
        }
        .form-box h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 10px;
            background: #fff;
        }
        .form-box button {
            width: 100%;
            margin-top: 20px;
            background-color:#218838;
            border: none;
            padding: 10px;
            border-radius: 10px;
            font-weight: 600;
            color: white;
            transition: background-color 0.3s ease;
        }
        .form-box button:hover {
            background-color: #218838;
        }
        .form-image {
            flex: 1 1 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .form-image img {
            max-width: 80%;
            border-radius: 15px;
        }
    </style>
</head>
<body>

    {{-- Include Navbar --}}
    @include('layouts.navbar')

    <div class="container page-content">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-container">
            <div class="form-box">
                <h2>Edit Akun</h2>
                <form action="{{ route('kelola_akun.update', $akun->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ $akun->nama }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ $akun->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ingin diubah">
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" required>
                            <option value="admin" {{ $akun->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $akun->role == 'user' ? 'selected' : '' }}>Pembeli</option>
                        </select>
                    </div>

                    <button type="submit">Simpan</button>
                </form>
            </div>

            <div class="form-image">
                <img src="{{ asset('images/kucing.png') }}" alt="Ilustrasi Kucing">
            </div>
        </div>
    </div>

    {{-- Include Footer --}}
    @include('layouts.footer')

</body>
</html>
