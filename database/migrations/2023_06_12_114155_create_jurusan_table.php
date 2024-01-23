<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurusanTable extends Migration
{
    public function up()
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id('JurusanID');
            $table->string('NamaJurusan');
            $table->text('Deskripsi');
            $table->unsignedBigInteger('JenjangID'); // Foreign key column
        
            $table->foreign('JenjangID')->references('JenjangID')->on('jenjang');
            $table->timestamps();
            $table->softDeletes(); // Tambahkan ini untuk soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('jurusan');
    }
}
