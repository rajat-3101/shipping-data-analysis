<?php

namespace App\Services;

use App\Models\Vessel;

class VesselService
{
    public function getAll()
    {
        return Vessel::all();
    }

    public function create(array $data)
    {
        // Convert array fields to JSON
        $data['fuel_oil_type'] = isset($data['fuel_oil_type']) ? json_encode($data['fuel_oil_type']) : null;
        $data['lubricating_oil_type'] = isset($data['lubricating_oil_type']) ? json_encode($data['lubricating_oil_type']) : null;
        $data['machinery'] = isset($data['machinery']) ? json_encode($data['machinery']) : null;
        return Vessel::create($data);
    }

    public function find($id)
    {
        return Vessel::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $vessel = Vessel::findOrFail($id);
        $data['fuel_oil_type'] = isset($data['fuel_oil_type']) ? json_encode($data['fuel_oil_type']) : null;
        $data['lubricating_oil_type'] = isset($data['lubricating_oil_type']) ? json_encode($data['lubricating_oil_type']) : null;
        $data['machinery'] = isset($data['machinery']) ? json_encode($data['machinery']) : null;
        $vessel->update($data);
        return $vessel;
    }

    public function delete($id)
    {
        $vessel = Vessel::findOrFail($id);
        $vessel->delete();
    }
}
