<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  // database/migrations/xxxx_xx_xx_create_representatives_table.php
public function up()
{
    Schema::create('representatives', function (Blueprint $table) {
        $table->id(); // Equivalente a `id` en la tabla `representatives`
        $table->string('name', 30);
        $table->string('first_last_name', 30);
        $table->string('second_last_name', 30);
        $table->string('curp', 18)->unique();
        $table->foreignId('faculty_id')->constrained('faculties')->onDelete('cascade'); // Asume que existe una tabla `faculties`
        $table->foreignId('identification_id')->constrained('identifications')->onDelete('cascade'); // Asume que existe una tabla `identifications`
        $table->string('identification_number', 15);
        $table->date('expedition_date');
        $table->string('email', 80);
        $table->string('phone', 10);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representatives');
    }
};
