<?php
namespace Database\Seeders;

use App\Models\VesselCategory;
use App\Models\VesselCoefficient;
use Illuminate\Database\Seeder;

class VesselCoefficientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bulkCarrier        = VesselCategory::where('name', 'Bulk Carrier')->first();
        $tanker             = VesselCategory::where('name', 'Tanker')->first();
        $containerShip      = VesselCategory::where('name', 'Container Ship')->first();
        $gasCarrier         = VesselCategory::where('name', 'Gas Carrier')->first();
        $generalCargo       = VesselCategory::where('name', 'General Cargo Ship')->first();
        $refrigeratedCargo  = VesselCategory::where('name', 'Refrigerated Cargo Carrier')->first();
        $combinationCarrier = VesselCategory::where('name', 'Combination Carrier')->first();
        $roRoCargo          = VesselCategory::where('name', 'Ro-Ro Cargo Ship')->first();
        $vehicleCarrier     = VesselCategory::where('name', 'Vehicle Carrier')->first();
        $roRoPassenger      = VesselCategory::where('name', 'Ro-Ro Passenger Ship')->first();
        $cruiseShip         = VesselCategory::where('name', 'Cruise Ship')->first();

        VesselCoefficient::insert([
            // Bulk Carrier
            [
                'vessel_category_id' => $bulkCarrier->id,
                'a'                => 1072.38,
                'c'                => -0.456,
                'min_capacity'     => 0,
                'max_capacity'     => 27999,
            ],
            [
                'vessel_category_id' => $bulkCarrier->id,
                'a'                => 961.79,
                'c'                => -0.477,
                'min_capacity'     => 28000,
                'max_capacity'     => null,
            ],

            // Tanker
            [
                'vessel_category_id' => $tanker->id,
                'a'                => 1055.49,
                'c'                => -0.456,
                'min_capacity'     => null,
                'max_capacity'     => null,
            ],

            // Container Ship
            [
                'vessel_category_id' => $containerShip->id,
                'a'                => 2373.10,
                'c'                => -0.474,
                'min_capacity'     => null,
                'max_capacity'     => null,
            ],

            // Gas Carrier
            [
                'vessel_category_id' => $gasCarrier->id,
                'a'                => 1660.12,
                'c'                => -0.502,
                'min_capacity'     => null,
                'max_capacity'     => null,
            ],

            // General Cargo Ship
            [
                'vessel_category_id' => $generalCargo->id,
                'a'                => 1895.88,
                'c'                => -0.525,
                'min_capacity'     => null,
                'max_capacity'     => null,
            ],

            // Refrigerated Cargo Carrier
            [
                'vessel_category_id' => $refrigeratedCargo->id,
                'a'                => 1748.43,
                'c'                => -0.526,
                'min_capacity'     => null,
                'max_capacity'     => null,
            ],

            // Combination Carrier
            [
                'vessel_category_id' => $combinationCarrier->id,
                'a'                => 1605.89,
                'c'                => -0.477,
                'min_capacity'     => null,
                'max_capacity'     => null,
            ],

            // Ro-Ro Cargo Ship
            [
                'vessel_category_id' => $roRoCargo->id,
                'a'                => 205.94,
                'c'                => -0.204,
                'min_capacity'     => null,
                'max_capacity'     => null,
            ],

            // Vehicle Carrier
            [
                'vessel_category_id' => $vehicleCarrier->id,
                'a'                => 144.82,
                'c'                => -0.195,
                'min_capacity'     => null,
                'max_capacity'     => null,
            ],

            // Ro-Ro Passenger Ship
            [
                'vessel_category_id' => $roRoPassenger->id,
                'a'                => 213.04,
                'c'                => -0.273,
                'min_capacity'     => null,
                'max_capacity'     => null,
            ],

            // Cruise Ship
            [
                'vessel_category_id' => $cruiseShip->id,
                'a'                => 111.73,
                'c'                => -0.217,
                'min_capacity'     => null,
                'max_capacity'     => null,
            ],
        ]);
    }
}
