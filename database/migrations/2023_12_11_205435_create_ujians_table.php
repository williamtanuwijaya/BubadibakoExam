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
        Schema::create('ujians', function (Blueprint $table) {
            $table->id('id_ujian');
            $table->string('nama_ujian');
            $table->foreignId('id_mapel')->references('id_mapel')->on('mata_pelajarans')->cascadeOnDelete();
            $table->foreignId('id_kelas')->references('id_kelas')->on('kelas')->cascadeOnDelete();
            $table->integer('durasi');
            $table->text('deskripsi');
            $table->enum('pertanyaan_acak', ['Y', 'N'])->default('Y');
            $table->enum('jawaban_acak', ['Y', 'N'])->default('Y');
            $table->enum('hasil', ['Y', 'N'])->default('N');
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
        Schema::dropIfExists('ujians');
    }
};
