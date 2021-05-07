<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanHamaModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_hama_models', function (Blueprint $table) {
            $table->id();
            $table->integer("peserta_id")->index();
            $table->longText("laporan");
            $table->text("file")->nullable();
            $table->integer("notiv_pengirim")
            $table->integer("pengirim")
            $table->integer("penerima")
            $table->integer("notiv_penerima")
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
        Schema::dropIfExists('laporan_hama_models');
    }
}
