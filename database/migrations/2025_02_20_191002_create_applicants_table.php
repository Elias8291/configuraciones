<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_applicants_table.php
public function up()
{
    Schema::create('applicants', function (Blueprint $table) {
        $table->id(); // Equivalente a `id` en la tabla `applicants`
        $table->foreignId('person_data_id')->constrained('person_data')->onDelete('cascade');
        $table->enum('application_status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->json('form_progress')->nullable();
        $table->text('reviewer_comments')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
