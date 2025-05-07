<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kelola_status_pesanans', function (Blueprint $table) {
            if (!Schema::hasColumn('kelola_status_pesanans', 'qty')) {
                $table->integer('qty')->default(1)->after('status_pesanan');
            }

            if (!Schema::hasColumn('kelola_status_pesanans', 'metode_pembayaran')) {
                $table->string('metode_pembayaran')->nullable()->after('qty');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kelola_status_pesanans', function (Blueprint $table) {
            $table->dropColumn(['qty', 'metode_pembayaran']);
        });
    }
};
