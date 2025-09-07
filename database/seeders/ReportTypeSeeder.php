<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReportType;

class ReportTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['report_name' => 'Noon Report', 'description' => 'Daily noon report for vessel operations'],
            ['report_name' => 'EOSP', 'description' => 'End of Sea Passage'],
            ['report_name' => 'COSP', 'description' => 'Commencement of Sea Passage'],
        ];
        foreach ($types as $type) {
            ReportType::updateOrCreate(['report_name' => $type['report_name']], $type);
        }
    }
}
