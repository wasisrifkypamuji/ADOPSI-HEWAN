<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('komen', function (Blueprint $table) {
            $table->bigIncrements('id_komen');  // Custom primary key
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_admin');
            $table->string('username');
            $table->string('foto');
            $table->string('video');
            $table->text('komen');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_admin')
                  ->references('id_admin')
                  ->on('admin')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('komen');
    }
};
