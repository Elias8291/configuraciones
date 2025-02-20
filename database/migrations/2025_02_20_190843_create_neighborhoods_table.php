<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_neighborhoods_table.php
public function up()
{
    Schema::create('neighborhoods', function (Blueprint $table) {
        $table->id(); // Equivalente a `id` en la tabla `neighborhood`
        $table->integer('zip_code');
        $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
        $table->string('name');
        $table->foreignId('settlement_type_id')->constrained('settlement_types')->onDelete('cascade');
        $table->foreignId('municipality_id')->constrained('municipalities')->onDelete('cascade');
        $table->integer('status')->default(1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neighborhoods');
    }
};
