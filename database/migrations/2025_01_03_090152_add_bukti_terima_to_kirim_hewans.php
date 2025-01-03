<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kirim_hewans', function (Blueprint $table) {
            // Menambah kolom bukti_terima yang bisa null
            $table->string('bukti_terima')->nullable()->after('status');
            // Menambah kolom alasan_penolakan yang bisa null
            $table->text('alasan_penolakan')->nullable()->after('bukti_terima');
            // Mengubah tipe data kolom status menjadi enum dengan nilai yang baru
            DB::statement("ALTER TABLE kirim_hewans MODIFY COLUMN status ENUM('proses', 'disetujui', 'ditolak') DEFAULT 'proses'");
        });
    }

    public function down()
    {
        Schema::table('kirim_hewans', function (Blueprint $table) {
            // Menghapus kolom jika dilakukan rollback
            $table->dropColumn(['bukti_terima', 'alasan_penolakan']);
            // Mengembalikan status ke nilai awal
            DB::statement("ALTER TABLE kirim_hewans MODIFY COLUMN status ENUM('proses', 'selesai') DEFAULT 'proses'");
        });
    }
};