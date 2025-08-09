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

            // Add user relationship - which user owns/manages this vessel
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            //vessel category
            $table->foreignId('vessel_category_id')->constrained('vessel_categories')->onDelete('cascade');

                                                       //vessel status
            $table->tinyInteger('status')->default(1); // 1 => Active, 0 => Inactive

            // $table->string('vessel_type', 100);

            // Basic Information (Step 1)
            $table->string('vessel_name');
            $table->string('flag', 100);
            $table->string('imo_no', 20)->nullable();
            $table->string('operation_manager')->nullable();

            // Technical Details (Step 2)
            $table->decimal('dwt', 12, 2)->nullable()->comment('Deadweight Ton');
            $table->decimal('gt', 12, 2)->nullable()->comment('Gross Ton');
            $table->decimal('nt', 12, 2)->nullable()->comment('Net Ton');
            $table->string('cargo_unit', 50)->nullable();
            $table->date('date_of_delivery')->nullable();
            $table->string('call_sign', 20)->nullable();
            $table->string('mmsi', 20)->nullable();
            $table->string('yard')->nullable()->comment('Delivery Yard');
            $table->string('port_of_registry')->nullable();
            $table->string('hull_no', 100)->nullable();
            $table->string('next_special_survey')->nullable()->comment('Dry Dock');
            $table->string('cargo_capacity', 100)->nullable();
            $table->text('specifications')->nullable();

            // Physical Specifications (Step 3)
            // Dimensions
            $table->string('loa', 50)->nullable()->comment('Length Overall');
            $table->string('lbp', 50)->nullable()->comment('Length Between Perpendiculars');
            $table->string('breadth', 50)->nullable();
            $table->string('depth', 50)->nullable();
            $table->string('draft', 50)->nullable();
            $table->string('full_displacement', 50)->nullable();
            $table->string('lightship_weight', 50)->nullable();

            // Performance Specifications
            $table->string('cruising_range_miles', 50)->nullable();
            $table->string('cruising_range_days', 50)->nullable();
            $table->string('sea_trial_knots', 50)->nullable();
            $table->string('sea_trial_draft', 50)->nullable();
            $table->string('service_knots', 50)->nullable();
            $table->string('ballast', 50)->nullable();
            $table->string('laden', 50)->nullable();

            //CII RATING
            $table->decimal('cii_rating_ration',5, 2)->nullable()->comment('CII Rating Ratio');
            $table->char('cii_rating_grade')->nullable()->comment('CII Rating Date');

            $table->softDeletes();
            $table->timestamps();

            // Updated Indexes
            $table->index('vessel_name');
            $table->index('imo_no');
            $table->index('vessel_category_id');
            $table->index('flag');
            $table->index(['organization_id', 'user_id']); // For efficient role-based queries
            $table->index(['vessel_name', 'imo_no', 'call_sign'], 'vessels_search_idx');
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
