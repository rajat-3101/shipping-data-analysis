<?php
namespace App\Services;

use App\Models\Voyage;

class VoyageService
{
    public function getAll($user)
    {
        // dd($user->role->id, config('constants.ROLES.ADMIN'));
        if ($user->role->id ===config('constants.ROLES.ADMIN')) {
            return Voyage::with('vessel')->get();
        }
        return Voyage::with('vessel')->whereHas('vessel', function($q) use ($user) {
            $q->where('organization_id', $user->organization_id);
        })->get();
    }

    public function create(array $data)
    {
        return Voyage::create($data); // voyage_name included if present
    }

    public function find($id)
    {
        return Voyage::findOrFail($id);
    }

    public function update(Voyage $voyage, array $data)
    {
        $voyage->update($data); // voyage_name included if present
        return $voyage;
    }

    public function delete(Voyage $voyage)
    {
        $voyage->delete();
    }
}
