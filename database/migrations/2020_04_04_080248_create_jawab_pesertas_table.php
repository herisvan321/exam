<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawab_pesertas', function (Blueprint $table) {
            $table->id();
            $table->integer('hujian_id')->index();
            $table->integer('soal_id')->index();
            $table->string('jawab');
            $table->integer('skor')->unsigned();
            $table->string('status_jawab');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawab_pesertas');
    }
}
