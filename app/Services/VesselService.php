<?php

namespace App\Services;

use App\Models\Vessel;
use Illuminate\Support\Facades\DB;

class VesselService
{
    public function getAll()
    {
        return Vessel::all();
    }

    public function create($request)
    {
        // dd($request);
        DB::beginTransaction();

            // Create the vessel
            $vessel = Vessel::create([
                'organization_id' => $request['organization_id'],
                'vessel_name' => $request['vessel_name'],
                'flag' => $request['flag'],
                'vessel_type' => $request['vessel_type'],
                'imo_no' => $request['imo_no'] ?? null,
                'owner' => $request['owner'] ?? null,
                'commercial_manager' => $request['commercial_manager'] ?? null,
                'technical_manager' => $request['technical_manager'] ?? null,
                'dwt' => $request['dwt'] ?? null,
                'gt' => $request['gt'] ?? null,
                'nt' => $request['nt'] ?? null,
                'cargo_unit' => $request['cargo_unit'] ?? null,
                'date_of_delivery' => $request['date_of_delivery'] ?? null,
                'call_sign' => $request['call_sign'] ?? null,
                'mmsi' => $request['mmsi'] ?? null,
                'yard' => $request['yard'] ?? null,
                'port_of_registry' => $request['port_of_registry'] ?? null,
                'hull_no' => $request['hull_no'] ?? null,
                'next_special_survey' => $request['next_special_survey'] ?? null,
                'cargo_capacity' => $request['cargo_capacity'] ?? null,
                'specifications' => $request['specifications'] ?? null,
                'loa' => $request['loa'] ?? null,
                'lbp' => $request['lbp'] ?? null,
                'breadth' => $request['breadth'] ?? null,
                'depth' => $request['depth'] ?? null,
                'draft' => $request['draft'] ?? null,
                'full_displacement' => $request['full_displacement'] ?? null,
                'lightship_weight' => $request['lightship_weight'] ?? null,
                'cruising_range_miles' => $request['cruising_range_miles'] ?? null,
                'cruising_range_days' => $request['cruising_range_days'] ?? null,
                'sea_trial_knots' => $request['sea_trial_knots'] ?? null,
                'sea_trial_draft' => $request['sea_trial_draft'] ?? null,
                'service_knots' => $request['service_knots'] ?? null,
                'ballast' => $request['ballast'] ?? null,
                'laden' => $request['laden'] ?? null,
            ]);

            // Attach fuel oil types
            if (!empty($request['fuel_oil_type'])) {
                $vessel->fuelOilTypes()->attach($request['fuel_oil_type']);
            }

            // Attach lubricating oil types
            if (!empty($request['lubricating_oil_type'])) {
                $vessel->lubricatingOilTypes()->attach($request['lubricating_oil_type']);
            }

            // Attach machinery types
            if (!empty($request['machinery'])) {
                $vessel->machineryTypes()->attach($request['machinery']);
            }

            DB::commit();

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
