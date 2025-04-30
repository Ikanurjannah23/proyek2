<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Perbaiki kurung kurawal di sini
        Schema::create('produks', function (Blueprint $table) {
            $table->id(); // sama dengan: $table->bigIncrements('id'); → auto unsigned
            $table->string('nama'); // misal ada
            $table->timestamps();
        });        
    }

    public function down()
    {
        // Hapus tabel jika migrasi di-rollback
        Schema::dropIfExists('kelola_keranjang_pesanans');
    }
};
