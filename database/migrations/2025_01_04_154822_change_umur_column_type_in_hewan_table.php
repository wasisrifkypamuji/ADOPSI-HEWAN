<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hewan', function (Blueprint $table) {
            $table->integer('umur')->unsigned()->change();
        });
    }
    
    public function down()
    {
        Schema::table('hewan', function (Blueprint $table) {
            $table->string('umur')->change();
        });
    }
};
