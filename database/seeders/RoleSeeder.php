<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         DB::table('roles')->insert([
            ["title" => "Admin", "role" => "ADMIN", "created_at" => now() , "updated_at" => now() ],
            ["title" => "Manager", "role" => "Manager", "created_at" => now() , "updated_at" => now() ],
            ["title" => "User", "role" => "User", "created_at" => now() , "updated_at" => now() ],
        ]) ;
    }
}
