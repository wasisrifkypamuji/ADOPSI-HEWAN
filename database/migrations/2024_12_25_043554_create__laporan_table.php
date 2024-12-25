<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');  // Custom primary key
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_adopsi');
            $table->string('foto');
            $table->string('video');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_adopsi')
                  ->references('id_adopsi')
                  ->on('adopsi')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan');
    }
};
