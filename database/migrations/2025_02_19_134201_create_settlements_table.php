<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSettlementsTable extends Migration
{
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('municipality_id')->unsigned();
            $table->bigInteger('locality_id')->unsigned()->nullable();
            $table->bigInteger('postal_code_id')->unsigned();
            $table->string('name', 100);
            $table->enum('type', ['Colonia', 'Fraccionamiento', 'Barrio', 'Unidad Habitacional', 'Otro']);
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
            $table->foreign('locality_id')->references('id')->on('localities')->onDelete('cascade');
            $table->foreign('postal_code_id')->references('id')->on('postal_codes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settlements');
    }
}
