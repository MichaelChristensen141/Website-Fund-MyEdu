<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('NamaDepan');
            $table->string('NamaBelakang')->nullable();
            $table->string('Status')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('TanggalLahir')->nullable();
            $table->string('Alamat')->nullable();
            $table->unsignedBigInteger('JurusanID')->nullable();
            $table->unsignedBigInteger('JenjangID')->nullable();
            $table->float('NilaiRata')->nullable();
            $table->string('PekerjaanOrtu')->nullable();
            $table->integer('PendapatanOrtu')->nullable();
            $table->integer('TahunLulus')->nullable();
            $table->text('RiwayatPrestasi')->nullable();
            $table->string('Gambar')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('JurusanID')->references('JurusanID')->on('jurusan');
            $table->foreign('JenjangID')->references('JenjangID')->on('jenjang');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
