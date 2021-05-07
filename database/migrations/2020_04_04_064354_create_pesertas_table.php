<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->integer('tingkat_id')->index();
            $table->integer('kelas_id')->index();
            $table->string('email');
            $table->string('password');
            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->string('is_name');
            $table->string('color');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->string('nohp');
            $table->integer('provinsi_id')->index()->nullable();
            $table->integer('kota_id')->index()->nullable();
            $table->integer('pos_id')->index()->nullable();
            $table->longText('alamat');
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('pesertas');
    }
}
