<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fuel_emission_factors', function (Blueprint $table) {
            $table->id();
            $table->string('fuel_type'); // e.g., HFO, MDO, LNG, etc.
            $table->decimal('co2_emission_factor', 10, 4); // CO2 emission factor in kg CO2 per GJ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_emission_factors');
    }
};
