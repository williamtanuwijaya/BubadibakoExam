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
        Schema::create('pertanyaans', function (Blueprint $table) {
            $table->id('id_pertanyaan');
            $table->foreignId('id_ujian')->references('id_ujian')->on('ujians')->cascadeOnDelete();
            $table->text('pertanyaan');
            $table->text('pilihan_1')->nullable();
            $table->text('pilihan_2')->nullable();
            $table->text('pilihan_3')->nullable();
            $table->text('pilihan_4')->nullable();
            $table->text('pilihan_5')->nullable();
            $table->integer('jawaban');
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
        Schema::dropIfExists('pertanyaans');
    }
};
