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
    Schema::table('kelola_status_pesanans', function (Blueprint $table) {
        if (!Schema::hasColumn('kelola_status_pesanans', 'no_telepon')) {
            $table->string('no_telepon')->nullable()->after('nama_pemesan');
        }
    });
}

public function down(): void
{
    Schema::table('kelola_status_pesanans', function (Blueprint $table) {
        $table->dropColumn('no_telepon');
    });
}
};
