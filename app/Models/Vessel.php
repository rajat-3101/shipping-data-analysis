<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $fillable = [
        'Organization_id',
        'vessel_name',
        'flag',
        'vessel_type',
        'imo_no',
        'owner',
        'commercial_manager',
        'technical_manager',
        'dwt',
        'gt',
        'nt',
        'cargo_unit',
        'date_of_delivery',
        'call_sign',
        'mmsi',
        'yard',
        'port_of_registry',
        'hull_no',
        'next_special_survey',
        'loa',
        'lbp',
        'breadth',
        'depth',
        'draft',
        'full_displacement',
        'lightvessel_weight',
        'cruising_range_miles',
        'cruising_range_days',
        'sea_trial_knots',
        'sea_trial_draft',
        'service_knots',
        'ballast',
        'laden',
        'fuel_oil_type',
        'lubricating_oil_type',
        'machinery',
        'cargo_capacity',
        'specifications',
    ];
}
