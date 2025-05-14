<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Khakiel Petshop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 100px;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #E5CBB7;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            z-index: 1000;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            width: 70px;
        }

        .logo .text {
            display: flex;
            flex-direction: column;
            font-size: 12px;
            color: #2c3e50;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: bold;
            font-size: 14px;
        }

        .nav-links a:hover {
            color: #a7a8a9;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 30px;
            left: 0;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            list-style: none;
            padding: 10px 0;
            z-index: 1001;  /* Ensure it is on top */
        }

        .dropdown-menu li a {
            display: block;
            padding: 8px 20px;
            font-size: 14px;
            color: #333;
        }

        .dropdown-menu li a:hover {
            background-color: #f0f0f0;
        }

        .right-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-box form {
            display: flex;
            align-items: center;
        }

        .search-box input {
            padding: 6px 12px;
            border-radius: 20px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            width: 160px;
            transition: width 0.3s ease;
        }

        .search-box input:focus {
            width: 200px;
            border-color: #999;
        }

        .account-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .account-actions svg {
            cursor: pointer;
            color: #2c3e50;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <!-- Logo -->
    <div class="logo">
        <img src="{{ asset('images/icon.png') }}" alt="Logo">
        <div class="text">
            <strong>KHAKIEL PETSHOP</strong>
            <p>Kebutuhan hewan kucing</p>
        </div>
    </div>

    <!-- Menu Tengah -->
    <ul class="nav-links">
        <li class="dropdown">
            <a href="#" onclick="toggleDropdown(event)">Kebutuhan Kucing</a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('makanankucing') }}">Makanan Kucing</a></li>
                <li><a href="{{ route('kebutuhanaksesoris') }}">Aksesoris</a></li>
                <li><a href="{{ route('kebutuhanperlengkapan') }}">Perlengkapan</a></li>
                <li><a href="{{ route('kebutuhanobat') }}">Obat - Obatan</a></li>
                <li><a href="{{ route('kebutuhanvitamin') }}">Vitamin Kucing</a></li>
            </ul>
        </li>
        <li><a href="{{ route('berandauser') }}">Beranda</a></li>
        <li><a href="{{ route('pesanan') }}">Pesanan</a></li>
    </ul>

    <!-- Search + Aksi Akun -->
    <div class="right-section">
        <div class="search-box">
            <form action="{{ route('produkmakanan.cari') }}" method="GET">
                <input type="text" name="search" placeholder="Cari produk..." />
            </form>
        </div>

        <div class="account-actions">
            <!-- Keranjang -->
            <a href="#" title="Keranjang">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
            </a>

           <!-- Profil Dropdown -->
<div class="dropdown">
    <a href="#" title="Profil">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
        </svg>
    </a>
    <ul class="dropdown-menu">
        <li><a href="#">Informasi Akun</a></li>
        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
    </ul>
</div>

            <!-- Logout Form -->
            <form id="logout-form" action="#" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>

<!-- Script Dropdowns -->
<script>
    function toggleDropdown(event) {
        event.preventDefault();
        event.stopPropagation();  // Prevent closing on clicking inside the dropdown
        const menu = event.target.nextElementSibling;
        const isOpen = menu.style.display === 'block';
        document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
        menu.style.display = isOpen ? 'none' : 'block';
    }

    window.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
        }
    });
</script>

</body>
</html>
