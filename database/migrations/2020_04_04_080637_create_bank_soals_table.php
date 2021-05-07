<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_soals', function (Blueprint $table) {
            $table->id();
            $table->integer('tingkat_id')->index();
            $table->integer('matpel_id')->index();
            $table->integer('type_soal')->unsigned();
            $table->integer('jenis_soal')->unsigned();
            $table->string('lable');
            $table->longText('soal');
            $table->longText('keterangan')->nullable();
            $table->string('jawaban');
            $table->integer('jlm_jawaban')->unsigned();
            $table->string('skor_soal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_soals');
    }
}
