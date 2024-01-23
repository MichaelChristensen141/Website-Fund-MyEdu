<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeasiswaJurusanTable extends Migration
{
    public function up()
    {
        Schema::create('beasiswa_jurusan', function (Blueprint $table) {
            $table->unsignedBigInteger('BeasiswaID');
            $table->unsignedBigInteger('JurusanID');
            $table->foreign('BeasiswaID')->references('BeasiswaID')->on('beasiswa');
            $table->foreign('JurusanID')->references('JurusanID')->on('jurusan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('beasiswa_jurusan');
    }
}
