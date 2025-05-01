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
        Schema::create('kelola_status_pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('akun_id');
            $table->unsignedBigInteger('produk_id');
            $table->string('status');
            $table->timestamps();
        
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
            $table->foreign('akun_id')->references('id')->on('akun')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_status_pesanans');
    }
};
