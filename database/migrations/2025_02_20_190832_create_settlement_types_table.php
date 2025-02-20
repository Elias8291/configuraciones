<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_settlement_types_table.php
public function up()
{
    Schema::create('settlement_types', function (Blueprint $table) {
        $table->id(); // Equivalente a `id` en la tabla `settlement_type`
        $table->string('name');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settlement_types');
    }
};
