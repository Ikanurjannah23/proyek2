<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlamatToKelolaStatusPesanansTable extends Migration
{
    public function up()
    {
        Schema::table('kelola_status_pesanans', function (Blueprint $table) {
            $table->string('alamat')->nullable()->after('no_telepon');
        });
    }

    public function down()
    {
        Schema::table('kelola_status_pesanans', function (Blueprint $table) {
            $table->dropColumn('alamat');
        });
    }
}
