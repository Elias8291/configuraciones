<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_addresses_table.php
public function up()
{
    Schema::create('addresses', function (Blueprint $table) {
        $table->id(); // Equivalente a `id` en la tabla `address`
        $table->string('street')->nullable();
        $table->string('exterior_number', 50)->nullable();
        $table->string('interior_number', 50)->nullable();
        $table->integer('zip_code')->nullable();
        $table->foreignId('neighborhood_id')->constrained('neighborhoods')->onDelete('cascade');
        $table->foreignId('municipality_id')->constrained('municipalities')->onDelete('cascade');
        $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
        $table->string('reference_street_1', 255)->nullable();
        $table->string('reference_street_2', 255)->nullable();
        $table->integer('status')->default(1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
