<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vessel;
use App\Models\Voyage;
use App\Services\NoonReportService;
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
        $users   = User::all();
        return view('noon_report.create', compact('vessels', 'voyages', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->noonReportService->create($data);
        toastr()->success('Noon report created successfully.');
        return redirect()->route('noon-report.index');
    }

    public function show($id)
    {
        $noonReport = \App\Models\NoonReport::with(['vessel', 'voyage', 'createdBy'])->findOrFail($id);
        return view('noon_report.show', compact('noonReport'));
    }

    public function edit($id)
    {
        $noonReport = $this->noonReportService->find($id);
        $vessels    = Vessel::all();
        $voyages    = Voyage::all();
        $users      = User::all();
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
        toastr()->success('Noon report deleted successfully.');
        return redirect()->route('noon-report.index');
    }
}
