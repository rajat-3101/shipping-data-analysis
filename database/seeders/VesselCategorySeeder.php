<?php
namespace Database\Seeders;

use App\Models\VesselCategory;
use Illuminate\Database\Seeder;

class VesselCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Bulk Carrier', 'capacity_type' => 'DWT'],
            ['name' => 'Tanker', 'capacity_type' => 'DWT'],
            ['name' => 'Container Ship', 'capacity_type' => 'DWT'],
            ['name' => 'Gas Carrier', 'capacity_type' => 'DWT'],
            ['name' => 'General Cargo Ship', 'capacity_type' => 'DWT'],
            ['name' => 'Refrigerated Cargo Carrier', 'capacity_type' => 'DWT'],
            ['name' => 'Combination Carrier', 'capacity_type' => 'DWT'],
            ['name' => 'Ro-Ro Cargo Ship', 'capacity_type' => 'GT'],
            ['name' => 'Vehicle Carrier', 'capacity_type' => 'GT'],
            ['name' => 'Ro-Ro Passenger Ship', 'capacity_type' => 'GT'],
            ['name' => 'Cruise Ship', 'capacity_type' => 'GT'],
        ];

        foreach ($categories as $category) {
            VesselCategory::create($category);
        }
    }
}
