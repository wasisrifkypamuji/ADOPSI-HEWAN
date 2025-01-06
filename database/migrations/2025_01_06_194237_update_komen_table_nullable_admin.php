<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKomenTableNullableAdmin extends Migration
{
    public function up()
    {
        Schema::table('komen', function (Blueprint $table) {
            $table->unsignedBigInteger('id_admin')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('komen', function (Blueprint $table) {
            $table->unsignedBigInteger('id_admin')->nullable(false)->change();
        });
    }
}