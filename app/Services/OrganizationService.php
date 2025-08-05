<?php

namespace App\Services;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrganizationService
{
    public function getAll()
    {
        return Organization::all();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
    
    try {
        // Create the organization
        $organization = Organization::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact_number' => $data['contact_number'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        // If a single user is provided (for manager/user creation)
        if (isset($data['name']) && isset($data['email']) && isset($data['password'])) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => config('constants.ROLES.MANAGER'), // Default to manager
                'organization_id' => $organization->id,
            ]);
        }

        DB::commit();
        return $organization;
        
    } catch (\Exception $e) {
        dd($e);
        DB::rollback();
        throw $e;
    }
    }

    public function update($id, array $data)
    {
        $organization = Organization::findOrFail($id);
        $organization->update($data);
        return $organization;
    }

    public function delete($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->delete();
    }
}
