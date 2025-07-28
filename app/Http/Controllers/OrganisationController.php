<?php

namespace App\Http\Controllers;

use App\Services\OrganisationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganisationController extends Controller
{
    protected $organisationService;

    public function __construct(OrganisationService $organisationService)
    {
        $this->organisationService = $organisationService;
    }

    public function index()
    {
        $organisations = $this->organisationService->getAll();
        return view('organisation.index', compact('organisations'));
    }

    public function store(Request $request)
    {
        $organisation = $this->organisationService->create($request->all());
        return response()->json($organisation, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $organisation = $this->organisationService->update($id, $request->all());
        return response()->json($organisation);
    }

    public function destroy($id)
    {
        $this->organisationService->delete($id);
        return response()->json(['message' => 'Organisation deleted successfully']);
    }
}
