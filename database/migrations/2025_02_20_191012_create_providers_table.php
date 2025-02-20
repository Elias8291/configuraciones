<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_providers_table.php
public function up()
{
    Schema::create('providers', function (Blueprint $table) {
        $table->id(); // Equivalente a `id` en la tabla `providers`
        $table->foreignId('person_data_id')->constrained('person_data')->onDelete('cascade');
        $table->foreignId('applicant_id')->constrained('applicants')->onDelete('cascade');
        $table->string('pv', 10)->nullable();
        $table->string('procedure_type', 15);
        $table->date('validity')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
