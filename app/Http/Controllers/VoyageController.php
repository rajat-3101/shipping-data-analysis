<?php
namespace App\Http\Controllers;

use App\Models\Voyage;
use App\Models\Vessel;
use Illuminate\Http\Request;
use App\Services\VoyageService;

class VoyageController extends Controller
{
    protected $voyageService;
    public function __construct(VoyageService $voyageService)
    {
        $this->middleware('auth');
        $this->voyageService = $voyageService;
    }

    public function index()
    {
        $user = auth()->user();
        $voyages = $this->voyageService->getAll($user);
        return view('voyage.index', compact('voyages'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->role->id === config('constants.ROLES.ADMIN')) {
            $vessels = \App\Models\Vessel::all();
        } else {
            $vessels = \App\Models\Vessel::where('organization_id', $user->organization_id)->get();
        }
        return view('voyage.create', compact('vessels'));
    }

    public function store(Request $request)
    {
        // dd('here');
        $user = auth()->user();

        $this->voyageService->create($request->all());
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
            'voyage_name' => 'required|string|max:200',
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
        $this->voyageService->update($voyage, $data);
        return redirect()->route('voyage.index')->with('success', 'Voyage updated successfully.');
    }

    public function destroy(Voyage $voyage)
    {
        $user = auth()->user();
        if (!in_array($user->role->role, ['admin', 'manager'])) {
            abort(403);
        }
        $this->voyageService->delete($voyage);
        return redirect()->route('voyage.index')->with('success', 'Voyage deleted successfully.');
    }
}
