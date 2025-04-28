<nav class="navbar">
    <div class="logo">
        <img src="{{ asset('images/icon.png') }}" alt="Logo" width="120">
        <div class="text">
            <strong>KHAKIEL PETSHOP</strong>
            <p>Kebutuhan hewan kucing terlengkap</p>
        </div>
    </div>

    <ul class="nav-links">
        <li><a href="#">Kelola Akun</a></li>
        <li><a href="{{ route('kelola.produk') }}" class="{{ request()->routeIs('kelola.produk') ? 'active' : '' }}">Kelola Produk</a></li>
        <li><a href="#">Kelola Keranjang Pesanan</a></li>
        <li><a href="{{ route('beranda.index') }}" class="{{ request()->routeIs('beranda.index') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="#">Laporan Penjualan</a></li>
        <li><a href="{{ route('kelolastatuspesanan.index') }}" class="{{ request()->routeIs('kelolastatuspesanan.index') ? 'active' : '' }}">Kelola Status Pesanan</a></li>
    </ul>

    <!-- Ikon Akun -->
    <div class="account-icon" onclick="toggleDropdown()">
        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8m-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5"/>
          </svg>
        <div class="dropdown-menu" id="dropdownMenu">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="
                    all: unset;
                    display: block;
                    padding: 8px 16px;
                    cursor: pointer;
                    color: #374151; /* Sesuaikan dengan warna teks 'Profil Admin' */
                    font-size: 16px;
                ">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<style>
.navbar {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #E5CBB7;
    padding: 20px 0;
    width: 100%;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    font-family: 'Poppins', sans-serif;
}

.logo {
    position: absolute;
    top: 15px;
    left: 15px;
    display: flex;
    align-items: center;
    gap: 5px;
    text-align: left;
}

.text {
    font-size: 13px;
    color: #2c3e50;
    display: flex;
    flex-direction: column;
    align-items: start;
}

.nav-links {
    display: flex;
    gap: 20px;
    list-style: none;
    margin-top: 55px;
}

.nav-links li {
    padding: 5px 10px;
}

.nav-links a {
    text-decoration: none;
    color: #2c3e50;
    font-weight: bold;
    transition: 0.3s;
}

.nav-links a:hover,
.nav-links a.active {
    color: #a7a8a9;
    border-bottom: 2px solid #a7a8a9;
}

/* Akun icon */
.account-icon {
    position: absolute;
    top: 20px;
    right: 20px;
    cursor: pointer;
}

.account-icon img {
    width: 35px;
    height: 35px;
    transition: transform 0.3s;
}

.account-icon img:hover {
    transform: scale(1.1);
}

/* Dropdown */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 50px;
    right: 0;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    overflow: hidden;
    flex-direction: column;
    min-width: 150px;
    z-index: 2000;
}

.dropdown-menu a {
    padding: 10px 15px;
    text-decoration: none;
    color: #2c3e50;
    font-size: 14px;
    display: block;
    transition: background-color 0.2s;
}

.dropdown-menu a:hover {
    background-color: #f0f0f0;
}
</style>

<!-- Javascript toggle -->
<script>
function toggleDropdown() {
    const dropdown = document.getElementById('dropdownMenu');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

// Tutup dropdown saat klik di luar
document.addEventListener('click', function(event) {
    const icon = document.querySelector('.account-icon');
    const dropdown = document.getElementById('dropdownMenu');
    if (!icon.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});
</script>
