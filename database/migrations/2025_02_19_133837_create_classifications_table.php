<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationsTable extends Migration
{
    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('description', 150);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('classifications');
    }
}
