<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');  // Custom primary key
            $table->string('username');
            $table->string('email');
            $table->string('nama_lengkap');
            $table->string('no_telepon');
            $table->text('alamat');
            $table->string('media_sosial');
            $table->string('usia');
            $table->string('pekerjaan');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
