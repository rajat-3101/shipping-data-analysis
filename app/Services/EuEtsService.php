<?php
namespace App\Services;

use App\Models\FuelEmissionFactor;
use App\Models\Vessel;
use Carbon\Carbon;

class EuEtsService
{
    // Placeholder for future EU ETS business logic

    public function calculateEUEts()
    {
        // fetch all vessels
        $getAllVessels = Vessel::with([
            'vesselCategory',
            'voyages' => function ($voyageQuery) {
                $voyageQuery->where(function ($q) {
                    $q->where('loading_port_eu', 1)
                        ->orWhere('discharge_port_eu', 1);
                })
                    ->with(['noonReports' => function ($reportQuery) {
                        $reportQuery->where('report_date', '>=', Carbon::now()->subYear());
                    }]);
            },
        ])
            ->where('status', config('constants.STATUS.ACTIVE'))
            ->whereHas('voyages', function ($voyageQuery) {
                $voyageQuery->where('loading_port_eu', 1)
                    ->orWhere('discharge_port_eu', 1);
            })
            ->orderBy('id', 'desc')
            ->get();

        // dd($getAllVessels);

        //get co2 emissions from fuel_emission_factors table
        $fuelEmissionFactors = FuelEmissionFactor::pluck('co2_emission_factor', 'fuel_type')->toArray();

        foreach ($getAllVessels as $vessel) {
            // dd($vessel->noonReports->count() > 0);
            // dd($vessel);
            //go through each voyage of the vessel
            foreach ($vessel->voyages as $voyage) {
                //skip if no noon reports available
                if ($voyage->noonReports->count() > 0) {
                    // dd($voyage->noonReports);

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

                    foreach ($voyage->noonReports as $report) {

                        //accumulate fuel consumption for each type
                        // Three differenet cal for 3 diff scenarios
                        # 1. Either Loading or Discharge port in EU
                        if ($voyage->loading_port_eu == 1 || $voyage->discharge_port_eu == 1) {
                            #if port is 
                        }

                        # 2. None port in EU // we do not need to calculate anything as the output will be zero
                        #3. Vessel in transit

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
                    $total_co2_emission_tonnes = $me_hfo_co2 + $me_lfo_co2 + $me_vlsfo_co2 + $me_mdo_mgo_co2;

                    $total_co2_emission_grams = $total_co2_emission_tonnes * 1_000_000; // convert MT to grams
                    dd($total_co2_emission_grams);

                }
            }

        }
    }

}
