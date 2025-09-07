<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PerformanceService;
use App\Models\Vessel;

class PerformanceController extends Controller
{
    protected $performanceService;

    public function __construct(PerformanceService $performanceService)
    {
        $this->performanceService = $performanceService;
    }

    public function index(Request $request)
    {
        $vessels = Vessel::all();
        $selectedVessel = $request->input('vessel_id', $vessels->first()?->id);
        $graphData = $this->performanceService->getSpeedRpmData($selectedVessel);
        return view('performance.index', compact('vessels', 'selectedVessel', 'graphData'));
    }
}
