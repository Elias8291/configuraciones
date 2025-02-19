<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalCodesTable extends Migration
{
    public function up()
    {
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('postal_code', 10)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('postal_codes');
    }
}
