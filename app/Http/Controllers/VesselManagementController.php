<?php

namespace App\Http\Controllers;

use App\Models\FuelOilType;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\MachineryType;
use Illuminate\Http\Response;
use App\Models\VesselCategory;
use App\Services\VesselService;
use App\Models\LubricatingOilType;

class VesselManagementController extends Controller
{
    protected $vesselService;

    public function __construct(VesselService $vesselService)
    {
        $this->vesselService = $vesselService;
    }

    public function index()
    {
        try {
            $vessels = $this->vesselService->getAll();
            // dd('here',$vessels );
            return view('vessel.index', compact('vessels'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Error fetching vessels: ' . $e->getMessage());
        }
    }

   public function create()
{
    try {
        $Organizations = Organization::all();
        $fuelOilTypes = FuelOilType::orderBy('name')->get();
        $lubricatingOilTypes = LubricatingOilType::orderBy('name')->get();
        $machineryTypes = MachineryType::orderBy('name')->get();
        $vesselCategories = VesselCategory::orderBy('name')->get();
        
        return view('vessel.create', compact(
            'Organizations', 
            'fuelOilTypes', 
            'lubricatingOilTypes', 
            'machineryTypes',
            'vesselCategories'
        ));
    } catch (\Exception $e) {
        \Log::error('Error loading vessel create form: ' . $e->getMessage());
        return redirect()->back()->withErrors('Error loading create form: ' . $e->getMessage());
    }
}
    public function store(Request $request)
    {
        try {
            $vessel = $this->vesselService->create($request->all());
            toastr()->success('Vessel created successfully.');
            return redirect()->route('vessel-management.index');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Error creating vessel: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $vessel = $this->vesselService->find($id);
            $Organizations = Organization::all();
            $fuelOilTypes = FuelOilType::orderBy('name')->get();
            $lubricatingOilTypes = LubricatingOilType::orderBy('name')->get();
            $machineryTypes = MachineryType::orderBy('name')->get();
            return view('vessel.edit', compact('vessel', 'Organizations', 'fuelOilTypes', 'lubricatingOilTypes', 'machineryTypes'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Error loading edit form: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vessel = $this->vesselService->update($id, $request->all());
            return redirect()->route('vessel-management.index')->with('success', 'Vessel updated successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Error updating vessel: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->vesselService->delete($id);
            return redirect()->route('vessel-management.index')->with('success', 'Vessel deleted successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Error deleting vessel: ' . $e->getMessage());
        }
    }
}
