<?php
namespace App\Services;

use App\Models\NoonReport;

class VesselMonitoringService
{
    public function getNoonReportsForVoyage($voyageId)
    {
        return NoonReport::where('voyage_id', $voyageId)
            ->with(['vessel', 'voyage', 'createdBy','reportType'])
            ->orderByDesc('report_date')
            ->get();
    }
}
