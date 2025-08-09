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
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vessel_id')->constrained('vessels')->onDelete('cascade');
            $table->tinyInteger('voyage_status')->default(0); // 0 => Planned, 1 => In Progress, 2 => Completed, 3 => Cancelled

            $table->string('voyage_name', 200);
            // Ports and timing
            $table->string('port_of_loading', 200);
            $table->string('port_of_discharge', 200);

            // Voyage dates
            $table->datetime('departure')->nullable();
            $table->datetime('arrival')->nullable();
            $table->datetime('voyage_commenced_at')->nullable(); // FAOP - Full Away on Passage
            $table->datetime('voyage_completed_at')->nullable();

            // Distance and performance planning
            $table->decimal('planned_distance', 10, 2)->nullable(); // Nautical miles
            $table->decimal('planned_speed', 5, 2)->nullable();     // Knots

            $table->text('remarks')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index(['vessel_id', 'voyage_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
