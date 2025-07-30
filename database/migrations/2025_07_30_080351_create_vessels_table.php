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
        Schema::create('vessels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained('organizations')->onDelete('cascade');
            $table->string('vessel_name');
            $table->string('flag')->nullable();
            $table->string('vessel_type')->nullable();
            $table->string('imo_no')->nullable();
            $table->string('owner')->nullable();
            $table->string('commercial_manager')->nullable();
            $table->string('technical_manager')->nullable();
            $table->float('dwt')->nullable();
            $table->float('gt')->nullable();
            $table->float('nt')->nullable();
            $table->string('cargo_unit')->nullable();
            $table->date('date_of_delivery')->nullable();
            $table->string('call_sign')->nullable();
            $table->string('mmsi')->nullable();
            $table->string('yard')->nullable();
            $table->string('port_of_registry')->nullable();
            $table->string('hull_no')->nullable();
            $table->string('next_special_survey')->nullable();
            $table->string('loa')->nullable();
            $table->string('lbp')->nullable();
            $table->string('breadth')->nullable();
            $table->string('depth')->nullable();
            $table->string('draft')->nullable();
            $table->string('full_displacement')->nullable();
            $table->string('lightvessel_weight')->nullable();
            $table->string('cruising_range_miles')->nullable();
            $table->string('cruising_range_days')->nullable();
            $table->string('sea_trial_knots')->nullable();
            $table->string('sea_trial_draft')->nullable();
            $table->string('service_knots')->nullable();
            $table->string('ballast')->nullable();
            $table->string('laden')->nullable();
            $table->text('fuel_oil_type')->nullable(); // store as JSON
            $table->text('lubricating_oil_type')->nullable(); // store as JSON
            $table->text('machinery')->nullable(); // store as JSON
            $table->string('cargo_capacity')->nullable();
            $table->text('specifications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessels');
    }
};
