<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rajat Mittal',
            'email' => config('constants.ADMIN_EMAIL'),
            'password' => Hash::make(config('constants.ADMIN_PASSWORD')),
            'role_id' => config('constants.ROLES.ADMIN'), 
        ]);

        User::create([
            'name' => 'Ankit Mittal',
            'email' => config('constants.USER_EMAIL'),
            'password' =>  Hash::make(config('constants.USER_PASSWORD')),
            'role_id' =>  config('constants.ROLES.MANAGER'), 
        ]);
    }
}
