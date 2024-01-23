<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerusahaanTable extends Migration
{
    public function up()
    {
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id('PerusahaanID');
            $table->string('NamaPerusahaan');
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
        Schema::dropIfExists('perusahaan');
    }
}
