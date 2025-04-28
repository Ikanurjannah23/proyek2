<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('aksesoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('jenis_produk');
            $table->integer('jumlah_stok');
            $table->string('harga'); // Harga disimpan dalam string
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel jika rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('aksesoris');
    }
};
