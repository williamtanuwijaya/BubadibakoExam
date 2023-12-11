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
        Schema::create('pelajars', function (Blueprint $table) {
            $table->id('id_pelajar');
            $table->foreignId('id_kelas')->references('id_kelas')->on('kelas')->cascadeOnDelete();
            $table->bigInteger('nisn')->unique();
            $table->string('nama');
            $table->string('kata_sandi');
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
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
        Schema::dropIfExists('pelajars');
    }
};
