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
        Schema::create('sesi_ujians', function (Blueprint $table) {
            $table->id('id_sesi_ujian');
            $table->foreignId('id_ujian')->references('id_ujian')->on('ujians')->cascadeOnDelete();
            $table->string('sesi_ujian');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
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
        Schema::dropIfExists('sesi_ujians');
    }
};
