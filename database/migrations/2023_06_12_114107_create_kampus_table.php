<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKampusTable extends Migration
{
    public function up()
    {
        Schema::create('kampus', function (Blueprint $table) {
            $table->id('KampusID');
            $table->string('NamaKampus');
            $table->string('Alamat');
            $table->string('Kontak');
            $table->string('Website');
            $table->string('Gambar')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Tambahkan ini untuk soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('kampus');
    }
}
