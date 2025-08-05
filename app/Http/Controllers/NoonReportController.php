<?php

namespace App\Http\Controllers;

use App\Services\NoonReportService;
use App\Models\Vessel;
use App\Models\Voyage;
use App\Models\User;
use Illuminate\Http\Request;

class NoonReportController extends Controller
{
    protected $noonReportService;

    public function __construct(NoonReportService $noonReportService)
    {
        $this->noonReportService = $noonReportService;
    }

    public function index()
    {
        $noonReports = $this->noonReportService->getAll();
        return view('noon_report.index', compact('noonReports'));
    }

    public function create()
    {
        $vessels = Vessel::all();
        $voyages = Voyage::all();
        $users = User::all();
        return view('noon_report.create', compact('vessels', 'voyages', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->noonReportService->create($data);
        return redirect()->route('noon-report.index')->with('success', 'Noon report created successfully.');
    }

    public function edit($id)
    {
        $noonReport = $this->noonReportService->find($id);
        $vessels = Vessel::all();
        $voyages = Voyage::all();
        $users = User::all();
        return view('noon_report.edit', compact('noonReport', 'vessels', 'voyages', 'users'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->noonReportService->update($id, $data);
        return redirect()->route('noon-report.index')->with('success', 'Noon report updated successfully.');
    }

    public function destroy($id)
    {
        $this->noonReportService->delete($id);
        return redirect()->route('noon-report.index')->with('success', 'Noon report deleted successfully.');
    }
}
