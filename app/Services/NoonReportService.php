<?php
namespace App\Services;

use App\Models\NoonReport;

class NoonReportService
{
    public function getAll()
    {
        return NoonReport::with(['vessel', 'voyage', 'createdBy','reportType'])->get();
    }

    public function find($id)
    {
        return NoonReport::with(['vessel', 'voyage', 'creator'])->findOrFail($id);
    }

    public function create(array $data)
    {
        // Set default values or calculate fields manually
        $processedData = $data;

        // Automatically set created_by to current authenticated user if not provided

        $processedData['created_by'] = auth()->id();

        // dd($processedData);
        return NoonReport::create($processedData);
    }

    public function update($id, array $data)
    {
        $report = NoonReport::findOrFail($id);
        $report->update($data);
        return $report;
    }

    public function delete($id)
    {
        $report = NoonReport::findOrFail($id);
        $report->delete();
    }
}
