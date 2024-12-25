<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->bigIncrements('id_kategori');  // Custom primary key
            $table->unsignedBigInteger('id_admin');
            $table->string('nama_kategori');
            $table->timestamps();

            $table->foreign('id_admin')
                  ->references('id_admin')  // Reference the custom primary key
                  ->on('admin')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori');
    }
};
