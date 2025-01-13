<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kirim_hewans', function (Blueprint $table) {
            $table->string('ras')->after('gender')->nullable(); // menambahkan setelah kolom gender
        });
    }

    public function down()
    {
        Schema::table('kirim_hewans', function (Blueprint $table) {
            $table->dropColumn('ras');
        });
    }
};