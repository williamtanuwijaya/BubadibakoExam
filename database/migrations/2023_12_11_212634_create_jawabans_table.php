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
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->foreignId('id_ujian')->references('id_ujian')->on('ujians')->cascadeOnDelete();
            $table->foreignId('id_sesi_ujian')->references('id_sesi_ujian')->on('sesi_ujians')->cascadeOnDelete();
            $table->foreignId('id_pertanyaan')->references('id_pertanyaan')->on('pertanyaans')->cascadeOnDelete();
            $table->foreignId('id_pelajar')->references('id_pelajar')->on('pelajars')->cascadeOnDelete();
            $table->integer('urutan_pertanyaan');
            $table->string('urutan_jawaban');
            $table->integer('jawwaban');
            $table->enum('jika_benar', ['Y', 'N'])->default('N');
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
        Schema::dropIfExists('jawabans');
    }
};
