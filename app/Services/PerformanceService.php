<?php
namespace App\Services;

use App\Models\Vessel;

class PerformanceService
{
    public function getSpeedRpmData($vesselId)
    {
        // Example: Fetch from noon reports or another table
        $vessel = Vessel::with(['noonReports:id,vessel_id,avg_speed_since_last_noon_report_log,average_engine_rpm_since_last_noon_report,engine_power,report_date'])
            ->whereId($vesselId)
            ->first();

        return $vessel;
    }
}
