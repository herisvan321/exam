<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->integer('matpel_id')->index();
            $table->integer('periode_id')->index();
            $table->string('title');
            $table->integer('jlm_soal')->unsigned();
            $table->longText('description');
            $table->integer('status_ujian')->unsigned();
            $table->integer('alokasi_waktu')->unsigned();
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
}
