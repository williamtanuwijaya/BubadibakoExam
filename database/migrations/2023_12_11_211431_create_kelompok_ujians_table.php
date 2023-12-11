<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok_ujians', function (Blueprint $table) {
            $table->id('id_kelompok_ujian');
            $table->foreignId('id_ujian')->references('id_ujian')->on('ujians')->cascadeOnDelete();
            $table->foreignId('id_sesi_ujian')->references('id_sesi_ujian')->on('sesi_ujians')->cascadeOnDelete();
            $table->foreignId('id_pelajar')->references('id_pelajar')->on('pelajars')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelompok_ujians');
    }
};
