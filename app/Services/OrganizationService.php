<?php

namespace App\Services;

use App\Models\Organization;

class OrganizationService
{
    public function getAll()
    {
        return Organization::all();
    }

    public function create(array $data)
    {
        return Organization::create($data);
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
