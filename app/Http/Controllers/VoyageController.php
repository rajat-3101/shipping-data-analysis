<?php
namespace App\Http\Controllers;

use App\Models\Voyage;
use App\Models\Vessel;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->role->role === 'admin') {
            $voyages = Voyage::with('vessel')->get();
        } elseif ($user->role->role === 'manager') {
            $voyages = Voyage::with('vessel')->whereHas('vessel', function($q) use ($user) {
                $q->where('organization_id', $user->organization_id);
            })->get();
        } else { // user
            $voyages = Voyage::with('vessel')->whereHas('vessel', function($q) use ($user) {
                $q->where('organization_id', $user->organization_id);
            })->get();
        }
        return view('voyage.index', compact('voyages'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->role->role === 'admin') {
            $vessels = \App\Models\Vessel::all();
        } else {
            $vessels = \App\Models\Vessel::where('organization_id', $user->organization_id)->get();
        }
        return view('voyage.create', compact('vessels'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if (!in_array($user->role->role, ['admin', 'manager'])) {
            abort(403);
        }
        $data = $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
            'voyage_status' => 'required|integer',
            'port_of_loading' => 'required|string',
            'port_of_discharge' => 'required|string',
            'departure' => 'nullable|date',
            'arrival' => 'nullable|date',
            'voyage_commenced_at' => 'nullable|date',
            'voyage_completed_at' => 'nullable|date',
            'planned_distance' => 'nullable|numeric',
            'planned_speed' => 'nullable|numeric',
            'remarks' => 'nullable|string',
        ]);
        Voyage::create($data);
        return redirect()->route('voyage.index')->with('success', 'Voyage created successfully.');
    }

    public function edit(Voyage $voyage)
    {
        $user = auth()->user();
        if (!in_array($user->role->role, ['admin', 'manager'])) {
            abort(403);
        }
        if ($user->role->role === 'admin') {
            $vessels = \App\Models\Vessel::all();
        } else {
            $vessels = \App\Models\Vessel::where('organization_id', $user->organization_id)->get();
        }
        return view('voyage.edit', compact('voyage', 'vessels'));
    }

    public function update(Request $request, Voyage $voyage)
    {
        $user = auth()->user();
        if (!in_array($user->role->role, ['admin', 'manager'])) {
            abort(403);
        }
        $data = $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
            'voyage_status' => 'required|integer',
            'port_of_loading' => 'required|string',
            'port_of_discharge' => 'required|string',
            'departure' => 'nullable|date',
            'arrival' => 'nullable|date',
            'voyage_commenced_at' => 'nullable|date',
            'voyage_completed_at' => 'nullable|date',
            'planned_distance' => 'nullable|numeric',
            'planned_speed' => 'nullable|numeric',
            'remarks' => 'nullable|string',
        ]);
        $voyage->update($data);
        return redirect()->route('voyage.index')->with('success', 'Voyage updated successfully.');
    }

    public function destroy(Voyage $voyage)
    {
        $user = auth()->user();
        if (!in_array($user->role->role, ['admin', 'manager'])) {
            abort(403);
        }
        $voyage->delete();
        return redirect()->route('voyage.index')->with('success', 'Voyage deleted successfully.');
    }
}
