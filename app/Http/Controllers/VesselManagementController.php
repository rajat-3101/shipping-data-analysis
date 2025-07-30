<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Services\VesselService;
use Illuminate\Http\Response;

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
            return view('vessel.create', compact('Organizations'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Error loading create form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $vessel = $this->vesselService->create($request->all());
            return redirect()->route('vessel-management.index')->with('success', 'Vessel created successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Error creating vessel: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $vessel = $this->vesselService->find($id);
            return view('vessel.edit', compact('vessel'));
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
