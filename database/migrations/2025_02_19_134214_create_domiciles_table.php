<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateDomicilesTable extends Migration
{
    public function up()
    {
        Schema::create('domiciles', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('state_id')->unsigned();
            $table->bigInteger('municipality_id')->unsigned();
            $table->bigInteger('locality_id')->unsigned()->nullable();
            $table->bigInteger('settlement_id')->unsigned();
            $table->string('street', 255);
            $table->string('exterior_number', 10);
            $table->string('interior_number', 10)->nullable();
            $table->string('reference_street_1', 255);
            $table->string('reference_street_2', 255);
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
            $table->foreign('locality_id')->references('id')->on('localities')->onDelete('cascade');
            $table->foreign('settlement_id')->references('id')->on('settlements')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('domiciles');
    }
}
