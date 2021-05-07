<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_ujians', function (Blueprint $table) {
            $table->id();
            $table->integer('peserta_id')->index();
            $table->integer('paket_id')->index();
            $table->integer('ujian_id')->index();
            $table->integer('ujian_ke')->unsigned();
            $table->datetime('waktu_mulai');
            $table->datetime('batas_waktu');
            $table->datetime('waktu_selesai')->nullable();
            $table->enum('status_ujian', ['0', '1'])->default('0');
            $table->integer('benar')->nullable();
            $table->integer('salah')->nullable();
            $table->string('nilai')->nullable();
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
        Schema::dropIfExists('history_ujians');
    }
}
