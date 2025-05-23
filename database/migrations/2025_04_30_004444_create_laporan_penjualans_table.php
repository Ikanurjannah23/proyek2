<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('laporan_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('kategori');
            $table->integer('jumlah_terjual');
            $table->integer('harga_satuan');
            $table->integer('total_penjualan');
            $table->date('tanggal');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_penjualans');
    }
};
