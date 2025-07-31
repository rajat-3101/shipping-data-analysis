<?php
namespace App\Services;

use App\Models\User;
use App\Models\Vessel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VesselService
{
    public function getAll()
    {
        return Vessel::all();
    }

    public function create($request)
    {
        // dd($request);
        try {
           
        // If a single user is provided (for manager/user creation)
        if (isset($request['vessel_name']) && isset($request['operation_manager_email']) && isset($request['password'])) {
            $user = User::create([
                'name' => $request['vessel_name'],
                'email' => $request['operation_manager_email'],
                'password' => Hash::make($request['password']),
                'role_id' => config('constants.ROLES.USER'), // Default to User
                'organization_id' => $request['organization_id'],
            ]);
        }
            // dd($user);
            // Create the vessel
            $vessel = Vessel::create([
                'organization_id'      => $request['organization_id'],
                'user_id'              => $user->id, // Add user assignment
                'vessel_name'          => $request['vessel_name'],
                'flag'                 => $request['flag'],
                'vessel_type'          => $request['vessel_type'],
                'imo_no'               => $request['imo_no'] ?? null,
                'owner'                => $request['owner'] ?? null,
                'operation_manager'   => $request['operation_manager'] ?? null,
                'dwt'                  => $request['dwt'] ?? null,
                'gt'                   => $request['gt'] ?? null,
                'nt'                   => $request['nt'] ?? null,
                'cargo_unit'           => $request['cargo_unit'] ?? null,
                'date_of_delivery'     => $request['date_of_delivery'] ?? null,
                'call_sign'            => $request['call_sign'] ?? null,
                'mmsi'                 => $request['mmsi'] ?? null,
                'yard'                 => $request['yard'] ?? null,
                'port_of_registry'     => $request['port_of_registry'] ?? null,
                'hull_no'              => $request['hull_no'] ?? null,
                'next_special_survey'  => $request['next_special_survey'] ?? null,
                'cargo_capacity'       => $request['cargo_capacity'] ?? null,
                'specifications'       => $request['specifications'] ?? null,
                'loa'                  => $request['loa'] ?? null,
                'lbp'                  => $request['lbp'] ?? null,
                'breadth'              => $request['breadth'] ?? null,
                'depth'                => $request['depth'] ?? null,
                'draft'                => $request['draft'] ?? null,
                'full_displacement'    => $request['full_displacement'] ?? null,
                'lightship_weight'     => $request['lightship_weight'] ?? null,
                'cruising_range_miles' => $request['cruising_range_miles'] ?? null,
                'cruising_range_days'  => $request['cruising_range_days'] ?? null,
                'sea_trial_knots'      => $request['sea_trial_knots'] ?? null,
                'sea_trial_draft'      => $request['sea_trial_draft'] ?? null,
                'service_knots'        => $request['service_knots'] ?? null,
                'ballast'              => $request['ballast'] ?? null,
                'laden'                => $request['laden'] ?? null,
            ]);

            // Attach fuel oil types
            if (! empty($request['fuel_oil_type'])) {
                $vessel->fuelOilTypes()->attach($request['fuel_oil_type']);
            }

            // Attach lubricating oil types
            if (! empty($request['lubricating_oil_type'])) {
                $vessel->lubricatingOilTypes()->attach($request['lubricating_oil_type']);
            }

            // Attach machinery types
            if (! empty($request['machinery'])) {
                $vessel->machineryTypes()->attach($request['machinery']);
            }

            DB::commit();
            return $vessel;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

    }

    public function find($id)
    {
        return Vessel::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $vessel                       = Vessel::findOrFail($id);
        $data['fuel_oil_type']        = isset($data['fuel_oil_type']) ? json_encode($data['fuel_oil_type']) : null;
        $data['lubricating_oil_type'] = isset($data['lubricating_oil_type']) ? json_encode($data['lubricating_oil_type']) : null;
        $data['machinery']            = isset($data['machinery']) ? json_encode($data['machinery']) : null;
        $vessel->update($data);
        return $vessel;
    }

    public function delete($id)
    {
        $vessel = Vessel::findOrFail($id);
        $vessel->delete();
    }
}
