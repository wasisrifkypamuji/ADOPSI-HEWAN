<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kirim_hewans', function (Blueprint $table) {
            // Menambahkan status baru ke enum
            \DB::statement("ALTER TABLE kirim_hewans MODIFY COLUMN status ENUM('proses', 'disetujui', 'ditolak', 'selesai') DEFAULT 'proses'");
        });
    }

    public function down()
    {
        Schema::table('kirim_hewans', function (Blueprint $table) {
            // Mengembalikan ke status awal
            \DB::statement("ALTER TABLE kirim_hewans MODIFY COLUMN status ENUM('proses', 'selesai') DEFAULT 'proses'");
        });
    }
};
