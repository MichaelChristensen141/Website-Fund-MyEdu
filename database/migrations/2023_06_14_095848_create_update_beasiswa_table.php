<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('beasiswa', function (Blueprint $table) {
            $table->enum('TipePemberi', ['kampus', 'non-kampus'])->default('kampus');
            $table->string('Pemberi')->nullable();
        });
    }

    public function down()
    {
        Schema::table('beasiswa', function (Blueprint $table) {
            $table->dropColumn('TipePemberi');
            $table->dropColumn('Pemberi');
        });
    }
};
