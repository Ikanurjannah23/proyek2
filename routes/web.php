<?php
use App\Http\Controllers\BerandaAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelolaProdukController;
use App\Http\Controllers\KelolaKeranjangPesananController;
use App\Models\KelolaStatusPesanan;
use App\Http\Controllers\KelolaStatusPesananController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\ProdukMakananController;
use App\Http\Controllers\AksesorisController;
use App\Http\Controllers\ObatobatanController;
use App\Http\Controllers\PerlengkapanController;
use App\Http\Controllers\VitaminKucingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelolaAkunController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/beranda', [BerandaAdminController::class, 'index'])->name('beranda.index');


Route::get('/kelolaproduk', [KelolaProdukController::class, 'index'])->name('kelolaproduk');


Route::get('/kelolastatuspesanan', [KelolaStatusPesananController::class, 'index'])->name('kelolastatuspesanan.index');
Route::post('/kelolastatuspesanan', [KelolaStatusPesananController::class, 'store'])->name('kelolastatuspesanan.store');
Route::get('/kelolastatuspesanan/{kelolastatuspesanan}/edit', [KelolaStatusPesananController::class, 'edit'])->name('kelolastatuspesanan.edit');
Route::put('/kelolastatuspesanan/{kelolastatuspesanan}', [KelolaStatusPesananController::class, 'update'])->name('kelolastatuspesanan.update');
Route::delete('/kelolastatuspesanan/{kelolastatuspesanan}', [KelolaStatusPesananController::class, 'destroy'])->name('kelolastatuspesanan.destroy');

Route::get('/kelola-produk', [KelolaProdukController::class, 'index'])->name('kelola.produk');



Route::get('/produkmakanan', [ProdukMakananController::class, 'index'])->name('produkmakanan.index');
Route::get('/produkmakanan/tambah', [ProdukMakananController::class, 'create'])->name('produkmakanan.create');
Route::post('/produkmakanan', [ProdukMakananController::class, 'store'])->name('produkmakanan.store');
Route::get('/produkmakanan/{id}/edit', [ProdukMakananController::class, 'edit'])->name('produkmakanan.edit');
Route::put('/produkmakanan/{id}', [ProdukMakananController::class, 'update'])->name('produkmakanan.update');
Route::delete('/produkmakanan/{id}', [ProdukMakananController::class, 'destroy'])->name('produkmakanan.destroy');

Route::get('/aksesoris', [AksesorisController::class, 'index'])->name('aksesoris.index');
Route::get('/aksesoris/create', [AksesorisController::class, 'create'])->name('aksesoris.create');
Route::post('/aksesoris', [AksesorisController::class, 'store'])->name('aksesoris.store');
Route::get('/aksesoris/{id}/edit', [AksesorisController::class, 'edit'])->name('aksesoris.edit');
Route::put('/aksesoris/{id}', [AksesorisController::class, 'update'])->name('aksesoris.update');
Route::delete('/aksesoris/{id}', [AksesorisController::class, 'destroy'])->name('aksesoris.destroy');

Route::get('/obatobatan', [ObatobatanController::class, 'index'])->name('obatobatan.index');
Route::get('/obatobatan/create', [ObatobatanController::class, 'create'])->name('obatobatan.create');
Route::post('/obatobatan', [ObatobatanController::class, 'store'])->name('obatobatan.store');
Route::get('/obatobatan/{id}/edit', [ObatobatanController::class, 'edit'])->name('obatobatan.edit');
Route::put('/obatobatan/{id}', [ObatobatanController::class, 'update'])->name('obatobatan.update');
Route::delete('/obatobatan/{id}', [ObatobatanController::class, 'destroy'])->name('obatobatan.destroy');

Route::get('/perlengkapan', [PerlengkapanController::class, 'index'])->name('perlengkapan.index');
Route::get('/perlengkapan/create', [PerlengkapanController::class, 'create'])->name('perlengkapan.create');
Route::post('/perlengkapan', [PerlengkapanController::class, 'store'])->name('perlengkapan.store');
Route::get('/perlengkapan/{id}/edit', [PerlengkapanController::class, 'edit'])->name('perlengkapan.edit');
Route::put('/perlengkapan/{id}', [PerlengkapanController::class, 'update'])->name('perlengkapan.update');
Route::delete('/perlengkapan/{id}', [PerlengkapanController::class, 'destroy'])->name('perlengkapan.destroy');

Route::get('/vitaminkucing', [VitaminKucingController::class, 'index'])->name('vitaminkucing.index');
Route::get('/vitaminkucing/create', [VitaminKucingController::class, 'create'])->name('vitaminkucing.create');
Route::post('/vitaminkucing', [VitaminKucingController::class, 'store'])->name('vitaminkucing.store');
Route::get('/vitaminkucing/{id}/edit', [VitaminKucingController::class, 'edit'])->name('vitaminkucing.edit');
Route::put('/vitaminkucing/{id}', [VitaminKucingController::class, 'update'])->name('vitaminkucing.update');
Route::delete('/vitaminkucing/{id}', [VitaminKucingController::class, 'destroy'])->name('vitaminkucing.destroy');

// Halaman Login - tanpa middleware
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout - tanpa middleware
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Rute untuk Kelola Akun
Route::resource('kelola_akun', KelolaAkunController::class);

// Rute Kelola Keranjang Pesanan
Route::get('/kelolakeranjangpesanan', [KelolaKeranjangPesananController::class, 'index'])->name('kelolakeranjangpesanan');
Route::get('/kelolakeranjangpesanan/create', [KelolaKeranjangPesananController::class, 'create'])->name('kelolakeranjangpesanan.create');
Route::post('/kelolakeranjangpesanan', [KelolaKeranjangPesananController::class, 'store'])->name('kelolakeranjangpesanan.store');  // Rute untuk simpan
Route::get('/kelolakeranjangpesanan/{id}/edit', [KelolaKeranjangPesananController::class, 'edit'])->name('kelolakeranjangpesanan.edit');  // Rute untuk form edit
Route::put('/kelolakeranjangpesanan/{id}', [KelolaKeranjangPesananController::class, 'update'])->name('kelolakeranjangpesanan.update');  // Rute untuk update

// Rute Laporan Penjualan
Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan_penjualan');

