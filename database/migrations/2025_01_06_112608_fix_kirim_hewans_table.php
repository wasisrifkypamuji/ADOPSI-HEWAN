<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('kirim_hewans');

        Schema::create('kirim_hewans', function (Blueprint $table) {
            $table->bigIncrements('id_kirim');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_kategori');
            $table->string('nama_lengkap');
            $table->string('nama_hewan');
            $table->text('deskripsi');
            $table->string('usia');
            $table->string('gender');
            $table->string('foto');
            $table->string('video')->nullable();
            $table->text('surat_perjanjian');
            $table->text('surat_keterangan_sehat');
            $table->text('alasan_penolakan')->nullable();
            $table->enum('status', ['proses', 'selesai', 'disetujui', 'ditolak'])->default('proses');
            $table->timestamps();

            $table->foreign('id_admin')
                  ->references('id_admin')
                  ->on('admin')
                  ->onDelete('set null');

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('kategori')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kirim_hewans');
    }
};