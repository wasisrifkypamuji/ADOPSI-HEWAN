<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // First check if alasan_penolakan doesn't exist before adding it
        if (!Schema::hasColumn('kirim_hewans', 'alasan_penolakan')) {
            Schema::table('kirim_hewans', function (Blueprint $table) {
                $table->text('alasan_penolakan')->nullable();
            });
        }

        // Update the enum values using DB::statement
        DB::statement("ALTER TABLE kirim_hewans MODIFY COLUMN status ENUM('proses', 'selesai', 'disetujui', 'ditolak') DEFAULT 'proses'");
    }

    public function down()
    {
        // Revert the enum values
        DB::statement("ALTER TABLE kirim_hewans MODIFY COLUMN status ENUM('proses', 'selesai') DEFAULT 'proses'");

        // Remove alasan_penolakan column if it exists
        if (Schema::hasColumn('kirim_hewans', 'alasan_penolakan')) {
            Schema::table('kirim_hewans', function (Blueprint $table) {
                $table->dropColumn('alasan_penolakan');
            });
        }
    }
};