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
        Schema::create('noon_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vessel_id')->constrained('vessels')->onDelete('cascade');
            $table->foreignId('voyage_id')->nullable()->constrained('voyages')->onDelete('set null');

            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');

            // Report identification and timing
            $table->string('voyage_comes_under')->nullable(); 
            $table->timestamp('report_date');
            $table->time('utc_time');                    // UTC
            $table->time('time_correction')->nullable(); // Time correction from LT to UTC

                                                     // Position
            $table->decimal('position_lat', 10, 3);  // Latitude with high precision
            $table->decimal('position_long', 11, 3); // Longitude with high precisio

            // Vessel Movement
            $table->enum('vessel_movement', ['At Sea', 'At Port'])->default('At Sea');

                                                                               // Distance and Performance
            $table->decimal('observed_distance_since_last_noon_report', 8, 2)->nullable(); // Nautical miles
            $table->decimal('log_distance', 8, 2)->nullable();                 // Nautical miles
            $table->decimal('engine_distance', 8, 2)->nullable();              // Nautical miles
            $table->decimal('sog_slip', 5, 2)->nullable();                      // Percentage
            $table->decimal('log_slip', 5, 2)->nullable();                     // Percentage

                                                                                  // Cumulative performance since FAOP
            $table->decimal('total_steaming_hours_since_faop', 8, 2)->nullable(); // Hours
            $table->decimal('total_distance_since_faop', 10, 2)->nullable();      // Nautical miles

                                                                                // Distance to go
            $table->decimal('distance_to_destination_port', 8, 2)->nullable();         // Nautical miles
            // $table->decimal('distance_to_final_destination', 8, 2)->nullable(); // Nautical miles

                                                                           // Speed averages
            $table->decimal('avg_speed_since_last_noon_report_sog', 5, 2)->nullable();  // Knots (Over Ground)
            $table->decimal('avg_speed_since_last_noon_report_log', 5, 2)->nullable(); // Knots (Log)

            // Engine Performance
            $table->decimal('average_engine_rpm_since_last_noon_report', 8, 2)->nullable();
            $table->decimal('avg_rpm_since_faop', 8, 2)->nullable();
            $table->decimal('engine_power', 8, 2)->nullable();  // kW
            $table->decimal('engine_torque', 8, 2)->nullable(); // kNm
            $table->decimal('engine_load_percentage', 5, 2)->nullable();   // Percentage

                                                                  // Weather Conditions
            $table->decimal('seawater_temp', 5, 2)->nullable();   // Celsius
            $table->decimal('atmosphere_temp', 5, 2)->nullable(); // Celsius
            $table->enum('wind_direction', ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW'])->nullable();
            $table->enum('wind_relative_direction', ['1', '2', '3', '4', '5', '6', '7', '8'])->nullable();
            $table->decimal('wind_speed_knots', 5, 2)->nullable();
            $table->integer('sea_direction')->nullable();          // Degrees (0-360)
            $table->integer('sea_state', false, true)->nullable(); // 0-9 scale
            $table->decimal('beaufort_force', 5, 2)->nullable();   // 0-12 scale

            //Marine Engine Fuel Consumption in tonnes
            $table->decimal('me_hfo', 10, 2)->nullable();
            $table->decimal('me_lfo', 10, 2)->nullable();
            $table->decimal('me_vlsfo', 10, 2)->nullable();
            $table->decimal('me_mdo_mgo', 10, 2)->nullable();

            //Auxiliary Engine Fuel Consumption in tonnes
            $table->decimal('ae_hfo', 10, 2)->nullable();
            $table->decimal('ae_lfo', 10, 2)->nullable();
            $table->decimal('ae_vlsfo', 10, 2)->nullable();
            $table->decimal('ae_mdo_mgo', 10, 2)->nullable();

            //Bioler Fuel Consumption in tonnes
            $table->decimal('boiler_hfo', 10, 2)->nullable();
            $table->decimal('boiler_lfo', 10, 2)->nullable();
            $table->decimal('boiler_vlsfo', 10, 2)->nullable();
            $table->decimal('boiler_mdo_mgo', 10, 2)->nullable();

            // ETA and Planning
            $table->datetime('eta_final_destination')->nullable();

            // Additional Fields
            $table->text('deviations')->nullable();
            $table->text('remarks')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Indexes for efficient querying
            $table->index(['vessel_id', 'report_date']);
            $table->index(['voyage_id', 'report_date']);

            // Unique constraint - one report per vessel per day
            $table->unique(['vessel_id', 'report_date'], 'unique_vessel_daily_report');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noon_reports');
    }
};
