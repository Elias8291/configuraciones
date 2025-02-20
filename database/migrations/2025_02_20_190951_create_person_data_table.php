<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
   {
    Schema::create('person_data', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('legal_person', 8);
        $table->string('rfc', 13)->unique();
        $table->string('curp', 18)->unique()->nullable();
        $table->string('business_name', 200);
        $table->string('tradename', 120)->nullable();
        $table->string('web_page', 50)->nullable();
        $table->enum('status', ['Pendiente', 'Validado', 'Rechazado'])->default('Pendiente');
        $table->string('activities', 60)->nullable();
        $table->string('economic_sector', 100)->nullable();
        $table->foreignId('classification_id')->nullable()->constrained('classifications')->onDelete('set null'); // Hacer nullable
        $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('cascade'); // Hacer nullable
        $table->foreignId('representative_id')->nullable()->constrained('representatives')->onDelete('set null'); // Hacer nullable
        $table->timestamps();
    });
   }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_data');
    }
};
