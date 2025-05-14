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
use App\Http\Controllers\KelolaBerandaController;
use App\Http\Controllers\FormPemesananController;
use App\Http\Controllers\KebutuhanAksesorisController;
use App\Http\Controllers\KebutuhanObatController;
use App\Http\Controllers\MakananKucingController;
use App\Http\Controllers\PaymentController;
use App\Models\User;
use App\Http\Controllers\MidtransCallbackController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/beranda', [BerandaAdminController::class, 'index'])->name('index');


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
Route::get('/loginadmin', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/loginadmin', [AuthController::class, 'login'])->name('loginadmin');

// Logout - tanpa middleware
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Rute untuk Kelola Akun
Route::resource('kelola_akun', KelolaAkunController::class);


// Rute Laporan Penjualan
Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan_penjualan');

Route::get('kelolaberanda', [KelolaBerandaController::class, 'index'])->name('kelolaberanda.index');
Route::get('kelolaberanda/create', [KelolaBerandaController::class, 'create'])->name('kelolaberanda.create');
Route::post('kelolaberanda', [KelolaBerandaController::class, 'store'])->name('kelolaberanda.store');
Route::get('kelolaberanda/{id}/edit', [KelolaBerandaController::class, 'edit'])->name('kelolaberanda.edit');
Route::put('kelolaberanda/{id}', [KelolaBerandaController::class, 'update'])->name('kelolaberanda.update');
Route::delete('kelolaberanda/{id}', [KelolaBerandaController::class, 'destroy'])->name('kelolaberanda.destroy');

use App\Http\Controllers\BerandaUserController;

// Route untuk halaman utama Beranda
Route::get('/berandauser', [BerandaUserController::class, 'index'])->name('berandauser');

// Route untuk halaman detail artikel Beranda
Route::get('/berandauser/{id}', [BerandaUserController::class, 'show'])->name('berandauser.show');
// routes/web.php

Route::get('/kebutuhan-kucing/makanankucing', [MakananKucingController::class, 'index'])->name('makanankucing');
Route::get('/kebutuhan-kucing/makanankucing/{id}', [MakananKucingController::class, 'show'])->name('makanankucing.show');

// Menampilkan form pemesanan berdasarkan ID produk
Route::get('/formpesanan/{jenis}/{id}', [FormPemesananController::class, 'show'])->name('formpesanan.show');

// Menyimpan data pemesanan ke database
Route::post('/formpesanan/store', [FormPemesananController::class, 'store'])->name('formpesanan.store');
Route::get('/kebutuhanaksesoris', [KebutuhanAksesorisController::class, 'index'])->name('kebutuhanaksesoris');
Route::get('/kebutuhanaksesoris/{id}', [KebutuhanAksesorisController::class, 'show'])->name('kebutuhanaksesoris.show');

use App\Http\Controllers\KebutuhanPerlengkapanController;

Route::get('/kebutuhanperlengkapan', [KebutuhanPerlengkapanController::class, 'index'])->name('kebutuhanperlengkapan');
Route::get('/detailkebutuhanperlengkapan/{id}', [KebutuhanPerlengkapanController::class, 'show'])->name('detailkebutuhanperlengkapan');

Route::get('/kebutuhanobat', [KebutuhanObatController::class, 'index'])->name('kebutuhanobat');
Route::get('/kebutuhanobat/{id}', [KebutuhanObatController::class, 'show'])->name('kebutuhanobat.show');

use App\Http\Controllers\KebutuhanVitaminController;
use App\Http\Controllers\PelangganController;

Route::get('/kebutuhanvitamin', [KebutuhanVitaminController::class, 'index'])->name('kebutuhanvitamin');
Route::get('/kebutuhanvitamin/{id}', [KebutuhanVitaminController::class, 'show'])->name('kebutuhanvitamin.show');

use App\Http\Controllers\PesananController;

Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');



// Rute untuk halaman login
Route::get('/login', [PelangganController::class, 'showMasuk'])->name('pelanggan.masuk');

// Rute untuk proses login
Route::post('/login', [PelangganController::class, 'masuk'])->name('pelanggan.masuk.submit');

// Rute untuk halaman pendaftaran
Route::get('/register', [PelangganController::class, 'showDaftar'])->name('pelanggan.daftar');

// Rute untuk proses pendaftaran
Route::post('/register', [PelangganController::class, 'daftar'])->name('pelanggan.daftar.submit');

// Rute untuk logout
Route::post('/logout', [PelangganController::class, 'keluar'])->name('pelanggan.keluar');


Route::post('/formpesanan/resume', [FormPemesananController::class, 'resume'])->name('formpesanan.resume');
Route::get('/formpesanan/resume', [FormPemesananController::class, 'resume'])->name('formpesanan.resume');

Route::get('/profile', [KelolaAkunController::class, 'profil'])->name('profil');


// Misalnya, jika kamu ingin mengakses dengan POST
Route::post('/formpesanan/resume', [FormPemesananController::class, 'resume'])->name('formpesanan.resume');

Route::get('/formpesanan/resume', [FormPemesananController::class, 'resume'])->name('formpesanan.resume');

Route::get('/keranjang', [FormPemesananController::class, 'keranjangPesanan'])->name('keranjang.pesanan');
Route::delete('/keranjang/{id}', [FormPemesananController::class, 'hapusPesanan'])->name('keranjang.hapus');

// baru

Route::prefix('formpesanan')->group(function () {
    Route::post('/pembayaran', [FormPemesananController::class, 'pembayaran'])->name('formpesanan.pembayaran');
    Route::get('/resume', [FormPemesananController::class, 'resume'])->name('formpesanan.resume');
    Route::post('/store', [FormPemesananController::class, 'store'])->name('formpesanan.store');
    Route::get('/show/{jenis}/{id}', [FormPemesananController::class, 'show'])->name('formpesanan.show');
});



Route::post('/simpan-pesanan', [KelolaStatusPesananController::class, 'simpanPesanan']);


Route::post('/midtrans/callback', [MidtransCallbackController::class, 'handle']);



Route::post('/simpan-pesanan', [KelolaStatusPesananController::class, 'simpanPesanan'])->name('simpan.pesanan');

Route::get('/produkmakanan/cari', [ProdukMakananController::class, 'cari'])->name('produkmakanan.cari');
Route::post('/kelolastatuspesanan/kirimwa', [KelolaStatusPesananController::class, 'kirimWaManual'])->name('kelolastatuspesanan.kirimwa');
Route::post('/kelolastatuspesanan/kirimwa', [KelolaStatusPesananController::class, 'kirimWaManual'])
    ->name('kelolastatuspesanan.kirimwa');


