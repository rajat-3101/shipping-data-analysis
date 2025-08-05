<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\FuelEmissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
 // Roles
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            VesselReferenceDataSeeder::class,
            FuelEmissionSeeder::class,
        ]);
    }
}
