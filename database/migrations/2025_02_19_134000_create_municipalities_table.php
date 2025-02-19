<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateMunicipalitiesTable extends Migration
{
    public function up()
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('state_id')->unsigned();
            $table->string('cve_mun', 10)->unique();
            $table->string('name', 100);
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('municipalities');
    }
}
