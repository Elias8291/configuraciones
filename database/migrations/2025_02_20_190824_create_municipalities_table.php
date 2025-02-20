<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 // database/migrations/xxxx_xx_xx_create_municipalities_table.php
public function up()
{
    Schema::create('municipalities', function (Blueprint $table) {
        $table->id(); // Equivalente a `id` en la tabla `municipality`
        $table->foreignId('state_id')->constrained('states')->onDelete('cascade');
        $table->string('name');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipalities');
    }
};
