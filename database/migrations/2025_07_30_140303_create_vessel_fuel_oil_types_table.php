<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vessel_fuel_oil_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vessel_id')->constrained()->onDelete('cascade');
            $table->foreignId('fuel_oil_type_id')->constrained()->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->timestamps();

            // $table->unique(['vessel_id', 'fuel_oil_type_id'], 'unique_vessel_fuel_oil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessel_fuel_oil_types');
    }
};
