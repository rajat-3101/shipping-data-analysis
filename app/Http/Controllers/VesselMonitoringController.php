<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VesselMonitoringService;
use App\Models\Vessel;
use App\Models\Voyage;

class VesselMonitoringController extends Controller
{
    protected $service;
    public function __construct(VesselMonitoringService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $vessels = Vessel::all();
        $selectedVessel = $request->input('vessel_id');
        $voyages = $selectedVessel ? Voyage::where('vessel_id', $selectedVessel)->get() : [];
        $selectedVoyage = $request->input('voyage_id');
        $noonReports = $selectedVoyage ? $this->service->getNoonReportsForVoyage($selectedVoyage) : collect();
        return view('vessel_monitoring.index', compact('vessels', 'voyages', 'selectedVessel', 'selectedVoyage', 'noonReports'));
    }

    public function getVoyages(Request $request)
    {
        $vesselId = $request->input('vessel_id');
        $voyages = $vesselId ? Voyage::where('vessel_id', $vesselId)->get(['id', 'voyage_name']) : [];
        return response()->json($voyages);
    }

    public function getNoonReports(Request $request)
    {
        $voyageId = $request->input('voyage_id');
        $reports = $voyageId ? $this->service->getNoonReportsForVoyage($voyageId) : collect();
        return response()->json($reports);
    }
}
