<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmobModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admob_models', function (Blueprint $table) {
            $table->id();
            $table->longText("id_application");
            $table->integer("status_banner");
            $table->longText("id_banner")->nullable();
            $table->integer("status_tayang");
            $table->longText("id_tayang")->nullable();
            $table->integer("status_native");
            $table->longText("id_native")->nullable();
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
        Schema::dropIfExists('admob_models');
    }
}
