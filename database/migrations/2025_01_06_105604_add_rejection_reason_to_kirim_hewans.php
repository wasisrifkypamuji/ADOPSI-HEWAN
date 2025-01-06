<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kirim_hewans', function (Blueprint $table) {
            // Tambah kolom alasan_penolakan
            $table->text('alasan_penolakan')->nullable();
            
            // Drop enum status yang lama
            $table->dropColumn('status');
            
            // Buat ulang enum status dengan opsi baru
            $table->enum('status', ['proses', 'selesai', 'disetujui', 'ditolak'])->default('proses');
        });
    }

    public function down()
    {
        Schema::table('kirim_hewans', function (Blueprint $table) {
            // Hapus kolom alasan_penolakan
            $table->dropColumn('alasan_penolakan');
            
            // Drop enum status yang baru
            $table->dropColumn('status');
            
            // Kembalikan enum status ke versi sebelumnya
            $table->enum('status', ['proses', 'selesai'])->default('proses');
        });
    }
};