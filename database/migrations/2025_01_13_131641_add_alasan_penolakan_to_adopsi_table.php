<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlasanPenolakanToAdopsiTable extends Migration
{
    public function up()
    {
        Schema::table('adopsi', function (Blueprint $table) {
            $table->string('alasan_penolakan')->nullable();
        });
    }

    public function down()
    {
        Schema::table('adopsi', function (Blueprint $table) {
            $table->dropColumn('alasan_penolakan');
        });
    }
}