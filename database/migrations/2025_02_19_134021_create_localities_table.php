<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateLocalitiesTable extends Migration
{
    public function up()
    {
        Schema::create('localities', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('municipality_id')->unsigned();
            $table->string('name', 100);
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('localities');
    }
}
