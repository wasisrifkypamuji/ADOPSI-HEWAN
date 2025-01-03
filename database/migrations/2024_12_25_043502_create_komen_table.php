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
            $table->string('foto')->nullable();
            $table->string('video')->nullable();
            $table->text('komen');
            $table->unsignedBigInteger('parent_id')->nullable(); 
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
        {
            Schema::table('komen', function (Blueprint $table) {
                if (!Schema::hasColumn('komen', 'parent_id')) {
                    $table->unsignedBigInteger('parent_id')->nullable();
                    $table->foreign('parent_id')
                        ->references('id_komen')
                        ->on('komen')
                        ->onDelete('cascade');
                }
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('komen');
        Schema::table('komen', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
};
