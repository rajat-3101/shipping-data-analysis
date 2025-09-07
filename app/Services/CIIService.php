<?php
namespace App\Services;

use App\Models\FuelEmissionFactor;
use App\Models\Vessel;
use App\Models\VesselCoefficient;
use Carbon\Carbon;

class CIIService
{
    public function calculateCII()
    {

        //fetch all vessels
        $getAllVessels = Vessel::with(['noonReports' => function ($query) {
            $query->where('report_date', '>=', Carbon::now()->subYear());
        }, 'vesselCategory'])
            ->where('status', config('constants.STATUS.ACTIVE'))
            ->OrderBy('id', 'desc')
            ->get();
        // dd($getAllVessels);
        //get co2 emissions from fuel_emission_factors table
        $fuelEmissionFactors = FuelEmissionFactor::pluck('co2_emission_factor', 'fuel_type')->toArray();

        foreach ($getAllVessels as $vessel) {
            // dd($vessel->noonReports->count() > 0);

            //skip if no noon reports available
            if ($vessel->noonReports->count() > 0) {

                //total distance traveled in nautical miles
                $total_distance = $vessel->noonReports->sum('log_distance');

                //main engine fuel consumption
                $me_hfo     = 0;
                $me_lfo     = 0;
                $me_vlsfo   = 0;
                $me_mdo_mgo = 0;

                //auxiliary engine fuel consumption
                $ae_hfo     = 0;
                $ae_lfo     = 0;
                $ae_vlsfo   = 0;
                $ae_mdo_mgo = 0;

                //boiler fuel consumption
                $boiler_hfo     = 0;
                $boiler_lfo     = 0;
                $boiler_vlsfo   = 0;
                $boiler_mdo_mgo = 0;

                foreach ($vessel->noonReports as $report) {

                    //accumulate fuel consumption for each type

                    //main engine fuel consumption
                    $me_hfo += $report->me_hfo ?? 0;
                    $me_lfo += $report->me_lfo ?? 0;
                    $me_vlsfo += $report->me_vlsfo ?? 0;
                    $me_mdo_mgo += $report->me_mdo_mgo ?? 0;

                    //auxiliary engine fuel consumption
                    $ae_hfo += $report->ae_hfo ?? 0;
                    $ae_lfo += $report->ae_lfo ?? 0;
                    $ae_vlsfo += $report->ae_vlsfo ?? 0;
                    $ae_mdo_mgo += $report->ae_mdo_mgo ?? 0;

                    //boiler fuel consumption
                    $boiler_hfo += $report->boiler_hfo ?? 0;
                    $boiler_lfo += $report->boiler_lfo ?? 0;
                    $boiler_vlsfo += $report->boiler_vlsfo ?? 0;
                    $boiler_mdo_mgo += $report->boiler_mdo_mgo ?? 0;

                }

                //calculate total fuel consumption
                $total_fuel_consumption_hfo     = $me_hfo + $ae_hfo + $boiler_hfo;
                $total_fuel_consumption_lfo     = $me_lfo + $ae_lfo + $boiler_lfo;
                $total_fuel_consumption_vlsfo   = $me_vlsfo + $ae_vlsfo + $boiler_vlsfo;
                $total_fuel_consumption_mdo_mgo = $me_mdo_mgo + $ae_mdo_mgo + $boiler_mdo_mgo;

                //co2 emission calculation by each fuel type
                $me_hfo_co2     = $total_fuel_consumption_hfo * $fuelEmissionFactors['Heavy Fuel Oil (HFO)'];
                $me_lfo_co2     = $total_fuel_consumption_lfo * $fuelEmissionFactors['Light Fuel Oil (LFO)'];
                $me_vlsfo_co2   = $total_fuel_consumption_vlsfo * $fuelEmissionFactors['Very Low Sulphur Fuel Oil (VLSFO)'];
                $me_mdo_mgo_co2 = $total_fuel_consumption_mdo_mgo * $fuelEmissionFactors['Marine Diesel Oil (MDO)/Marine Gas Oil (MGO)'];

                //total co2 emission
                $total_co2_emission = $me_hfo_co2 + $me_lfo_co2 + $me_vlsfo_co2 + $me_mdo_mgo_co2;

                $total_co2_emission_grams = $total_co2_emission * 1_000_000; // convert MT to grams
                                                                             // dd($total_co2_emission_grams);

                $dead_weight = $vessel->dwt; // in metric tons

                // Fetch the vessel coefficient based on the vessel category and dead weight
                $coefficient = VesselCoefficient::where('vessel_category_id', $vessel->vessel_category_id)
                    ->where(function ($q) use ($dead_weight) {
                        $q->whereNull('min_capacity')->orWhere('min_capacity', '<=', $dead_weight);
                    })
                    ->where(function ($q) use ($dead_weight) {
                        $q->whereNull('max_capacity')->orWhere('max_capacity', '>=', $dead_weight);
                    })
                    ->first();

                // $year = $request->year;
                // dd($dead_weight*$total_distance);
                // Step 1: Attained CII
                $attainedCii = $total_co2_emission_grams / ($dead_weight * $total_distance);
                // dd($attainedCii);

                // Step 2: Required CII

                                                                                         //calculate the reference cii
                $reference_cii = $coefficient->a / (pow($dead_weight, $coefficient->c)); //reference cii
                                                                                         //  dd($reference_cii);

                $reductionFactor = config('constants.REDUCTION_FACTOR');

                // required cii calculation
                $requiredCii = $reference_cii * (1 - $reductionFactor);
                // dd($requiredCii);

                // Step 3: CII Rating
                // Calculate the CII rating ratio
                $ciiRatingRatio = $attainedCii / $requiredCii;
                // dd($ciiRatingRatio,$attainedCii, $requiredCii);

                // Step 3: Calculate boundaries (fixed ratios)
                $boundaries = [
                    'A' => 0.86,
                    'B' => 0.94,
                    'C' => 1.06,
                    'D' => 1.13,
                ];

                // Step 4: Determine Rating based on ciiRatingRatio
                if ($ciiRatingRatio <= $boundaries['A']) {
                    $rating = 'A';
                } elseif ($ciiRatingRatio <= $boundaries['B']) {
                    $rating = 'B';
                } elseif ($ciiRatingRatio <= $boundaries['C']) {
                    $rating = 'C';
                } elseif ($ciiRatingRatio <= $boundaries['D']) {
                    $rating = 'D';
                } else {
                    $rating = 'E';
                }

                // dd($ciiRatingRatio,$rating);
                //update the cii ratio and rating in the vessel
                $updatedVessel = Vessel::where('id', $vessel->id)
                    ->update([
                        'cii_rating_ratio' => $ciiRatingRatio,
                        'cii_rating_grade' => $rating,
                    ]);
                // dd($vessel);
            }
        }

        return Vessel::get();
    }
}
