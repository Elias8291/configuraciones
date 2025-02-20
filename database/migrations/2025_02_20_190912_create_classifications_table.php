<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_classifications_table.php
public function up()
{
    Schema::create('classifications', function (Blueprint $table) {
        $table->id(); // Equivalente a `id` en la tabla `classifications`
        $table->string('description', 150);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifications');
    }
};
