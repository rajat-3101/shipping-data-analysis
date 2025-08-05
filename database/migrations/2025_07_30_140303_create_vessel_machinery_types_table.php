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
        Schema::create('vessel_machinery_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vessel_id')->constrained()->onDelete('cascade');
            $table->foreignId('machinery_type_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->text('specifications')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // $table->unique(['vessel_id', 'machinery_type_id'], 'unique_vessel_machinery');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessel_machinery_types');
    }
};
