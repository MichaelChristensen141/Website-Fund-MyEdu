<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeasiswaJenjangTable extends Migration
{
    public function up()
    {
        Schema::create('beasiswa_jenjang', function (Blueprint $table) {
            $table->unsignedBigInteger('BeasiswaID');
            $table->unsignedBigInteger('JenjangID');
            $table->foreign('BeasiswaID')->references('BeasiswaID')->on('beasiswa');
            $table->foreign('JenjangID')->references('JenjangID')->on('jenjang');
        });
    }

    public function down()
    {
        Schema::dropIfExists('beasiswa_jenjang');
    }
}
