<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelolaberanda', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('gambar'); // nama file gambar
            $table->date('tanggal');
            $table->text('deskripsi_singkat');
            $table->longText('isi_artikel');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelolaberanda');
    }
};
