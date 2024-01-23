<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenjangTable extends Migration
{
    public function up()
    {
        Schema::create('jenjang', function (Blueprint $table) {
            $table->id('JenjangID');
            $table->string('NamaJenjang');
            $table->text('Deskripsi');
            $table->timestamps();
            $table->softDeletes(); // Tambahkan ini untuk soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenjang');
    }
}
