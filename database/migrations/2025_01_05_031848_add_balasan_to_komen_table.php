<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBalasanToKomenTable extends Migration
{
    public function up()
    {
        Schema::table('komen', function (Blueprint $table) {
            $table->text('balasan')->nullable()->after('komen'); // Tambahkan kolom balasan
        });
    }

    public function down()
    {
        Schema::table('komen', function (Blueprint $table) {
            $table->dropColumn('balasan');
        });
    }
}
