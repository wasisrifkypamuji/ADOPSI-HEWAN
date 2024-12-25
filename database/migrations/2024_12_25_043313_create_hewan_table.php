<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hewan', function (Blueprint $table) {
            $table->bigIncrements('id_hewan');  // Custom primary key
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_kategori');
            $table->string('nama_hewan');
            $table->string('umur');
            $table->string('gender');
            $table->string('ras');
            $table->text('deskripsi');
            $table->string('foto');
            $table->string('status_adopsi');
            $table->timestamps();

            $table->foreign('id_admin')
                  ->references('id_admin')
                  ->on('admin')
                  ->onDelete('cascade');
            
            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('kategori')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hewan');
    }
};
