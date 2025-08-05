<?php

namespace Database\Seeders;

use App\Models\FuelOilType;
use App\Models\MachineryType;
use Illuminate\Database\Seeder;
use App\Models\LubricatingOilType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VesselReferenceDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fuel Oil Types
        $fuelOilTypes = [
            'LNG', 'HFO', 'LFO', 'MDO', 'MGO', 
            'LPG (Propane)', 'LPG (Butane)', 'Methanol', 
            'Ethanol', 'B23'
        ];

        foreach ($fuelOilTypes as $type) {
            FuelOilType::firstOrCreate(['name' => $type]);
        }

        // Lubricating Oil Types
        $lubricatingOilTypes = [
            'M/E Cylinder Oil',
            'M/E Cylinder Oil (Low Sulfur)',
            'M/E System Oil',
            'M/E Sump Tank',
            'G/E System Oil',
            'TG System Oil',
        ];

        foreach ($lubricatingOilTypes as $type) {
            LubricatingOilType::firstOrCreate(['name' => $type]);
        }

        // Machinery Types
        $machineryTypes = [
            'Main Engine',
            'Generator Engine',
            'Boiler',
            'Inert Gas Generator',
            'Incinerator',
            'Gas Combustion Unit',
        ];

        foreach ($machineryTypes as $type) {
            MachineryType::firstOrCreate(['name' => $type]);
        }
    }
}
