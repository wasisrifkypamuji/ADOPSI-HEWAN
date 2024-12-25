<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('adopsi', function (Blueprint $table) {
            $table->bigIncrements('id_adopsi');  // Custom primary key
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('user_id');
            $table->string('username');
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('no_telepon');
            $table->text('alamat');
            $table->string('pekerjaan');
            $table->unsignedBigInteger('id_hewan');
            $table->unsignedBigInteger('id_pertanyaan');
            $table->string('nama_hewan');
            $table->string('status_adopsi');
            $table->timestamps();

            $table->foreign('id_admin')
                  ->references('id_admin')
                  ->on('admin')
                  ->onDelete('cascade');
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_hewan')
                  ->references('id_hewan')
                  ->on('hewan')
                  ->onDelete('cascade');

            $table->foreign('id_pertanyaan')
                  ->references('id_pertanyaan')
                  ->on('pertanyaan')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('adopsi');
    }
};
