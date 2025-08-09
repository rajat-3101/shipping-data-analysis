<?php

namespace App\Services;

use App\Models\Vessel;
use App\Models\Voyage;
use App\Models\NoonReport;
use App\Models\Organization;

class DashboardService
{
    public function getDashboardStats()
    {
        return [
            'totalVessels' => Vessel::count(),
            'totalOrganizations' => Organization::count(),
            'totalVoyages' => Voyage::count(),
            'totalNoonReports' => NoonReport::count(),
        ];
    }
}
