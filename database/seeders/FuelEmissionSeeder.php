<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuelEmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fuel_emission_factors')->insert([
            ['fuel_type' => 'Heavy Fuel Oil (HFO)', 'co2_emission_factor' => 3.13],
            ['fuel_type' => 'Marine Diesel Oil (MDO)/Marine Gas Oil (MGO)', 'co2_emission_factor' => 3.21],
            ['fuel_type' => 'Very Low Sulphur Fuel Oil (VLSFO)', 'co2_emission_factor' => 3.13],
            ['fuel_type' => 'Light Fuel Oil (LFO)', 'co2_emission_factor' => 3.18],
        ]);
    }
}
