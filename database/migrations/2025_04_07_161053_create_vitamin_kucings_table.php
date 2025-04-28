<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vitaminkucing', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('jenis_produk');
            $table->integer('stok');
            $table->string('harga'); // Harga menggunakan tipe string
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vitaminkucing');
    }
};
