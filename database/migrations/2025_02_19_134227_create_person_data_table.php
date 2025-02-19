<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonDataTable extends Migration
{
    public function up()
    {
        Schema::create('person_data', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('legal_person', 8)->nullable();
            $table->string('rfc', 13)->unique(); // Unique RFC
            $table->string('legal_name', 200)->nullable(); // Legal name attribute
            $table->string('business_name', 200)->nullable();
            $table->string('tradename', 120)->nullable();
            $table->string('web_page', 50)->nullable();
            $table->enum('status', ['Pending', 'Validated', 'Rejected'])->default('Pending');
            $table->string('activities', 60)->nullable();
            $table->string('economic_sector', 100)->nullable();
            $table->bigInteger('classification_id')->unsigned()->nullable(); // Permite NULL
            $table->bigInteger('domicile_id')->unsigned()->nullable(); // Permite NULL
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('domicile_id')->references('id')->on('domiciles')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('person_data');
    }
}
