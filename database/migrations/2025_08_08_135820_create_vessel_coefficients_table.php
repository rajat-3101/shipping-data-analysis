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
        Schema::create('vessel_coefficients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vessel_category_id')->constrained()->onDelete('cascade');
            $table->double('a', 10, 5);
            $table->double('c', 10, 5);
            $table->unsignedInteger('min_capacity')->nullable();
            $table->unsignedInteger('max_capacity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessel_coefficients');
    }
};
