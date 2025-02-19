<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('person_data_id')->unsigned()->unique();
            $table->enum('application_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->json('form_progress')->nullable();
            $table->text('reviewer_comments')->nullable();
            $table->timestamps();
            $table->foreign('person_data_id')->references('id')->on('person_data')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
