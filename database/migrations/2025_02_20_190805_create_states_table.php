<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_states_table.php
public function up()
{
    Schema::create('states', function (Blueprint $table) {
        $table->id(); // Equivalente a `id` en la tabla `states`
        $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
        $table->string('name');
        $table->string('abbreviation', 10);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
