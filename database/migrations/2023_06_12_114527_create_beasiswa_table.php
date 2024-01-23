<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->id('BeasiswaID');
            $table->text('CrawlingId')->nullable();
            $table->text('Source')->nullable();
            $table->string('NamaBeasiswa');
            $table->text('Deskripsi');
            $table->text('Persyaratan');
            $table->date('TanggalPendaftaran');
            $table->date('TanggalPenutupan');
            $table->integer('TahunMasuk');
            $table->string('Pembiayaan');
            $table->integer('JumlahPenerima');
            $table->text('Kontak');
            $table->enum('TipeBeasiswa', ['Kampus', 'Non-Kampus'])->default('Kampus');
            $table->unsignedBigInteger('KampusID')->nullable();
            $table->foreign('KampusID')->references('KampusID')->on('kampus');
            $table->unsignedBigInteger('PerusahaanID')->nullable();
            $table->foreign('PerusahaanID')->references('PerusahaanID')->on('perusahaan');
            $table->timestamps();
            $table->softDeletes(); // Tambahkan ini untuk soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('beasiswa');
    }
}
