@extends('adminlte::page')
@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Noon Report Details</h2>
    <div class="card shadow" style="max-width: 900px; margin: 0 auto;">
        <div class="card-body">
            <a href="{{ route('noon-report.index') }}" class="btn btn-secondary mb-3">Back to List</a>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr><th>Vessel</th><td>{{ $noonReport->vessel->vessel_name ?? '-' }}</td></tr>
                    <tr><th>Voyage</th><td>{{ $noonReport->voyage->voyage_name ?? '-' }}</td></tr>
                    <tr><th>Report Date</th><td>{{ $noonReport->report_date }}</td></tr>
                    <tr><th>Created By</th><td>{{ $noonReport->createdBy->name ?? '-' }}</td></tr>
                    <tr><th>Local Time</th><td>{{ $noonReport->local_time }}</td></tr>
                    <tr><th>UTC Time</th><td>{{ $noonReport->utc_time }}</td></tr>
                    <tr><th>Time Correction</th><td>{{ $noonReport->time_correction }}</td></tr>
                    <tr><th>Latitude</th><td>{{ $noonReport->position_lat }}</td></tr>
                    <tr><th>Longitude</th><td>{{ $noonReport->position_long }}</td></tr>
                    <tr><th>Vessel Movement</th><td>{{ $noonReport->vessel_movement }}</td></tr>
                    <tr><th>Observed Distance Since Last</th><td>{{ $noonReport->observed_distance_since_last }}</td></tr>
                    <tr><th>Log Distance</th><td>{{ $noonReport->log_distance }}</td></tr>
                    <tr><th>Engine Distance</th><td>{{ $noonReport->engine_distance }}</td></tr>
                    <tr><th>OG Slip (%)</th><td>{{ $noonReport->og_slip }}</td></tr>
                    <tr><th>Log Slip (%)</th><td>{{ $noonReport->log_slip }}</td></tr>
                    <tr><th>Total Steaming Hours Since FAOP</th><td>{{ $noonReport->total_steaming_hours_since_faop }}</td></tr>
                    <tr><th>Total Distance Since FAOP</th><td>{{ $noonReport->total_distance_since_faop }}</td></tr>
                    <tr><th>Distance to Next Port</th><td>{{ $noonReport->distance_to_next_port }}</td></tr>
                    <tr><th>Distance to Final Destination</th><td>{{ $noonReport->distance_to_final_destination }}</td></tr>
                    <tr><th>Avg Speed Since Last (OG)</th><td>{{ $noonReport->avg_speed_since_last_og }}</td></tr>
                    <tr><th>Avg Speed Since Last (Log)</th><td>{{ $noonReport->avg_speed_since_last_log }}</td></tr>
                    <tr><th>Engine RPM Since Last Noon</th><td>{{ $noonReport->engine_rpm_since_last_noon }}</td></tr>
                    <tr><th>Avg RPM Since FAOP</th><td>{{ $noonReport->avg_rpm_since_faop }}</td></tr>
                    <tr><th>Engine Power (kW)</th><td>{{ $noonReport->engine_power }}</td></tr>
                    <tr><th>Engine Torque (kNm)</th><td>{{ $noonReport->engine_torque }}</td></tr>
                    <tr><th>Seawater Temp (°C)</th><td>{{ $noonReport->seawater_temp }}</td></tr>
                    <tr><th>Atmosphere Temp (°C)</th><td>{{ $noonReport->atmosphere_temp }}</td></tr>
                    <tr><th>Wind Direction</th><td>{{ $noonReport->wind_direction }}</td></tr>
                    <tr><th>Wind Relative Direction</th><td>{{ $noonReport->wind_relative_direction }}</td></tr>
                    <tr><th>Wind Speed (knots)</th><td>{{ $noonReport->wind_speed_knots }}</td></tr>
                    <tr><th>Sea Direction (°)</th><td>{{ $noonReport->sea_direction }}</td></tr>
                    <tr><th>Sea State</th><td>{{ $noonReport->sea_state }}</td></tr>
                    <tr><th>Beaufort Force</th><td>{{ $noonReport->beaufort_force }}</td></tr>
                    <tr><th>ME HFO</th><td>{{ $noonReport->me_hfo }}</td></tr>
                    <tr><th>ME LFO</th><td>{{ $noonReport->me_lfo }}</td></tr>
                    <tr><th>ME VLSFO</th><td>{{ $noonReport->me_vlsfo }}</td></tr>
                    <tr><th>ME MDO/MGO</th><td>{{ $noonReport->me_mdo_mgo }}</td></tr>
                    <tr><th>AE HFO</th><td>{{ $noonReport->ae_hfo }}</td></tr>
                    <tr><th>AE LFO</th><td>{{ $noonReport->ae_lfo }}</td></tr>
                    <tr><th>AE VLSFO</th><td>{{ $noonReport->ae_vlsfo }}</td></tr>
                    <tr><th>AE MDO/MGO</th><td>{{ $noonReport->ae_mdo_mgo }}</td></tr>
                    <tr><th>Boiler HFO</th><td>{{ $noonReport->boiler_hfo }}</td></tr>
                    <tr><th>Boiler LFO</th><td>{{ $noonReport->boiler_lfo }}</td></tr>
                    <tr><th>Boiler VLSFO</th><td>{{ $noonReport->boiler_vlsfo }}</td></tr>
                    <tr><th>Boiler MDO/MGO</th><td>{{ $noonReport->boiler_mdo_mgo }}</td></tr>
                    <tr><th>ETA Final Destination</th><td>{{ $noonReport->eta_final_destination }}</td></tr>
                    <tr><th>Deviations</th><td>{{ $noonReport->deviations }}</td></tr>
                    <tr><th>Remarks</th><td>{{ $noonReport->remarks }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
