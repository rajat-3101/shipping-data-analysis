<?php

namespace App\Http\Controllers;

use App\Services\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganizationController extends Controller
{
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function index()
    {
        try {
            $organizations = $this->organizationService->getAll();
            return view('organization.index', compact('organizations'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Error fetching organizations: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('organization.create');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error loading create form: ' . $e->getMessage());
        }
    }
    
    public function store(Request $request)
    {
        try {
            $organization = $this->organizationService->create($request->all());
            return redirect()->route('organization-management.index');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating organization: ' . $e->getMessage()], 500);
        }
    }

     public function edit($id)
    {
        try {
            $Organizations = Organization::all();
            return view('organization.edit', compact( 'Organizations'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Error loading edit form: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $organization = $this->organizationService->update($id, $request->all());
            return response()->json($organization);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating organization: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->organizationService->delete($id);
            return redirect()->route('organization-management.index')->with('success', 'Vessel deleted successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting organization: ' . $e->getMessage()], 500);
        }
    }
}
