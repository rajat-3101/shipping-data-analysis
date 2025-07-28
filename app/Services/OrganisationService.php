<?php

namespace App\Services;

use App\Models\Organisation;

class OrganisationService
{
    public function getAll()
    {
        return Organisation::all();
    }

    public function create(array $data)
    {
        return Organisation::create($data);
    }

    public function update($id, array $data)
    {
        $organisation = Organisation::findOrFail($id);
        $organisation->update($data);
        return $organisation;
    }

    public function delete($id)
    {
        $organisation = Organisation::findOrFail($id);
        $organisation->delete();
    }
}
