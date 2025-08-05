@extends('adminlte::page')
@section('content')
<div class="container">
    <h1>Edit Noon Report</h1>
    <form action="{{ route('noon-report.update', $noonReport->id) }}" method="POST" id="noonReportForm">
        @csrf
        @method('PUT')
        <!-- Step 1: Basic Info -->
        <div class="step-content" id="step1">
            <div class="card mb-3">
                <div class="card-header"><h4>Step 1: Basic Info</h4></div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="vessel_id" class="form-label">Vessel <span class="text-danger">*</span></label>
                            <select name="vessel_id" id="vessel_id" class="form-control" required>
                                <option value="">Select Vessel</option>
                                @foreach($vessels as $vessel)
                                    <option value="{{ $vessel->id }}" {{ $noonReport->vessel_id == $vessel->id ? 'selected' : '' }}>{{ $vessel->vessel_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="voyage_id" class="form-label">Voyage</label>
                            <select name="voyage_id" id="voyage_id" class="form-control">
                                <option value="">Select Voyage</option>
                                @foreach($voyages as $voyage)
                                    <option value="{{ $voyage->id }}" {{ $noonReport->voyage_id == $voyage->id ? 'selected' : '' }}>{{ $voyage->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="report_date" class="form-label">Report Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="report_date" name="report_date" value="{{ $noonReport->report_date }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="created_by" class="form-label">Created By</label>
                            <select name="created_by" id="created_by" class="form-control">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $noonReport->created_by == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="local_time" class="form-label">Local Time (LT)</label>
                            <input type="time" class="form-control" id="local_time" name="local_time" value="{{ $noonReport->local_time }}">
                        </div>
                        <div class="mb-3">
                            <label for="utc_time" class="form-label">UTC Time</label>
                            <input type="time" class="form-control" id="utc_time" name="utc_time" value="{{ $noonReport->utc_time }}">
                        </div>
                        <div class="mb-3">
                            <label for="time_correction" class="form-label">Time Correction</label>
                            <input type="time" class="form-control" id="time_correction" name="time_correction" value="{{ $noonReport->time_correction }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Step 2: Position & Movement -->
        <div class="step-content" id="step2" style="display:none;">
            <div class="card mb-3">
                <div class="card-header"><h4>Step 2: Position & Movement</h4></div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="position_lat" class="form-label">Latitude</label>
                            <input type="number" step="0.0000001" class="form-control" id="position_lat" name="position_lat" value="{{ $noonReport->position_lat }}">
                        </div>
                        <div class="mb-3">
                            <label for="position_long" class="form-label">Longitude</label>
                            <input type="number" step="0.0000001" class="form-control" id="position_long" name="position_long" value="{{ $noonReport->position_long }}">
                        </div>
                        <div class="mb-3">
                            <label for="vessel_movement" class="form-label">Vessel Movement</label>
                            <select name="vessel_movement" id="vessel_movement" class="form-control">
                                <option value="Steaming" {{ $noonReport->vessel_movement == 'Steaming' ? 'selected' : '' }}>Steaming</option>
                                <option value="At Anchor" {{ $noonReport->vessel_movement == 'At Anchor' ? 'selected' : '' }}>At Anchor</option>
                                <option value="At Berth" {{ $noonReport->vessel_movement == 'At Berth' ? 'selected' : '' }}>At Berth</option>
                                <option value="Drifting" {{ $noonReport->vessel_movement == 'Drifting' ? 'selected' : '' }}>Drifting</option>
                                <option value="Maneuvering" {{ $noonReport->vessel_movement == 'Maneuvering' ? 'selected' : '' }}>Maneuvering</option>
                                <option value="Port Operations" {{ $noonReport->vessel_movement == 'Port Operations' ? 'selected' : '' }}>Port Operations</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="observed_distance_since_last" class="form-label">Observed Distance Since Last (NM)</label>
                            <input type="number" step="0.01" class="form-control" id="observed_distance_since_last" name="observed_distance_since_last" value="{{ $noonReport->observed_distance_since_last }}">
                        </div>
                        <div class="mb-3">
                            <label for="log_distance" class="form-label">Log Distance (NM)</label>
                            <input type="number" step="0.01" class="form-control" id="log_distance" name="log_distance" value="{{ $noonReport->log_distance }}">
                        </div>
                        <div class="mb-3">
                            <label for="engine_distance" class="form-label">Engine Distance (NM)</label>
                            <input type="number" step="0.01" class="form-control" id="engine_distance" name="engine_distance" value="{{ $noonReport->engine_distance }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Step 3: Performance & Weather -->
        <div class="step-content" id="step3" style="display:none;">
            <div class="card mb-3">
                <div class="card-header"><h4>Step 3: Performance & Weather</h4></div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="og_slip" class="form-label">OG Slip (%)</label>
                            <input type="number" step="0.01" class="form-control" id="og_slip" name="og_slip" value="{{ $noonReport->og_slip }}">
                        </div>
                        <div class="mb-3">
                            <label for="log_slip" class="form-label">Log Slip (%)</label>
                            <input type="number" step="0.01" class="form-control" id="log_slip" name="log_slip" value="{{ $noonReport->log_slip }}">
                        </div>
                        <div class="mb-3">
                            <label for="total_steaming_hours_since_faop" class="form-label">Total Steaming Hours Since FAOP</label>
                            <input type="number" step="0.01" class="form-control" id="total_steaming_hours_since_faop" name="total_steaming_hours_since_faop" value="{{ $noonReport->total_steaming_hours_since_faop }}">
                        </div>
                        <div class="mb-3">
                            <label for="total_distance_since_faop" class="form-label">Total Distance Since FAOP (NM)</label>
                            <input type="number" step="0.01" class="form-control" id="total_distance_since_faop" name="total_distance_since_faop" value="{{ $noonReport->total_distance_since_faop }}">
                        </div>
                        <div class="mb-3">
                            <label for="distance_to_next_port" class="form-label">Distance to Next Port (NM)</label>
                            <input type="number" step="0.01" class="form-control" id="distance_to_next_port" name="distance_to_next_port" value="{{ $noonReport->distance_to_next_port }}">
                        </div>
                        <div class="mb-3">
                            <label for="distance_to_final_destination" class="form-label">Distance to Final Destination (NM)</label>
                            <input type="number" step="0.01" class="form-control" id="distance_to_final_destination" name="distance_to_final_destination" value="{{ $noonReport->distance_to_final_destination }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="avg_speed_since_last_og" class="form-label">Avg Speed Since Last (OG) (Knots)</label>
                            <input type="number" step="0.01" class="form-control" id="avg_speed_since_last_og" name="avg_speed_since_last_og" value="{{ $noonReport->avg_speed_since_last_og }}">
                        </div>
                        <div class="mb-3">
                            <label for="avg_speed_since_last_log" class="form-label">Avg Speed Since Last (Log) (Knots)</label>
                            <input type="number" step="0.01" class="form-control" id="avg_speed_since_last_log" name="avg_speed_since_last_log" value="{{ $noonReport->avg_speed_since_last_log }}">
                        </div>
                        <div class="mb-3">
                            <label for="engine_rpm_since_last_noon" class="form-label">Engine RPM Since Last Noon</label>
                            <input type="number" step="0.01" class="form-control" id="engine_rpm_since_last_noon" name="engine_rpm_since_last_noon" value="{{ $noonReport->engine_rpm_since_last_noon }}">
                        </div>
                        <div class="mb-3">
                            <label for="avg_rpm_since_faop" class="form-label">Avg RPM Since FAOP</label>
                            <input type="number" step="0.01" class="form-control" id="avg_rpm_since_faop" name="avg_rpm_since_faop" value="{{ $noonReport->avg_rpm_since_faop }}">
                        </div>
                        <div class="mb-3">
                            <label for="engine_power" class="form-label">Engine Power (kW)</label>
                            <input type="number" step="0.01" class="form-control" id="engine_power" name="engine_power" value="{{ $noonReport->engine_power }}">
                        </div>
                        <div class="mb-3">
                            <label for="engine_torque" class="form-label">Engine Torque (kNm)</label>
                            <input type="number" step="0.01" class="form-control" id="engine_torque" name="engine_torque" value="{{ $noonReport->engine_torque }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Step 4: Weather & Fuel -->
        <div class="step-content" id="step4" style="display:none;">
            <div class="card mb-3">
                <div class="card-header"><h4>Step 4: Weather & Fuel</h4></div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="seawater_temp" class="form-label">Seawater Temp (°C)</label>
                            <input type="number" step="0.1" class="form-control" id="seawater_temp" name="seawater_temp" value="{{ $noonReport->seawater_temp }}">
                        </div>
                        <div class="mb-3">
                            <label for="atmosphere_temp" class="form-label">Atmosphere Temp (°C)</label>
                            <input type="number" step="0.1" class="form-control" id="atmosphere_temp" name="atmosphere_temp" value="{{ $noonReport->atmosphere_temp }}">
                        </div>
                        <div class="mb-3">
                            <label for="wind_direction" class="form-label">Wind Direction</label>
                            <select name="wind_direction" id="wind_direction" class="form-control">
                                <option value="">Select</option>
                                @foreach(['N','NNE','NE','ENE','E','ESE','SE','SSE','S','SSW','SW','WSW','W','WNW','NW','NNW'] as $dir)
                                    <option value="{{ $dir }}" {{ $noonReport->wind_direction == $dir ? 'selected' : '' }}>{{ $dir }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="wind_relative_direction" class="form-label">Wind Relative Direction</label>
                            <select name="wind_relative_direction" id="wind_relative_direction" class="form-control">
                                <option value="">Select</option>
                                @foreach(['1','2','3','4','5','6','7','8'] as $rel)
                                    <option value="{{ $rel }}" {{ $noonReport->wind_relative_direction == $rel ? 'selected' : '' }}>{{ $rel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="wind_speed_knots" class="form-label">Wind Speed (knots)</label>
                            <input type="number" step="0.1" class="form-control" id="wind_speed_knots" name="wind_speed_knots" value="{{ $noonReport->wind_speed_knots }}">
                        </div>
                        <div class="mb-3">
                            <label for="sea_direction" class="form-label">Sea Direction (°)</label>
                            <input type="number" class="form-control" id="sea_direction" name="sea_direction" value="{{ $noonReport->sea_direction }}">
                        </div>
                        <div class="mb-3">
                            <label for="sea_state" class="form-label">Sea State (0-9)</label>
                            <input type="number" min="0" max="9" class="form-control" id="sea_state" name="sea_state" value="{{ $noonReport->sea_state }}">
                        </div>
                        <div class="mb-3">
                            <label for="beaufort_force" class="form-label">Beaufort Force (0-12)</label>
                            <input type="number" min="0" max="12" step="0.1" class="form-control" id="beaufort_force" name="beaufort_force" value="{{ $noonReport->beaufort_force }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Marine Engine Fuel Consumption (tonnes)</h5>
                        <div class="mb-3">
                            <label for="me_hsfo" class="form-label">ME HSFO</label>
                            <input type="number" step="0.1" class="form-control" id="me_hsfo" name="me_hsfo" value="{{ $noonReport->me_hsfo }}">
                        </div>
                        <div class="mb-3">
                            <label for="me_lsfo" class="form-label">ME LSFO</label>
                            <input type="number" step="0.1" class="form-control" id="me_lsfo" name="me_lsfo" value="{{ $noonReport->me_lsfo }}">
                        </div>
                        <div class="mb-3">
                            <label for="me_vlfo" class="form-label">ME VLFO</label>
                            <input type="number" step="0.1" class="form-control" id="me_vlfo" name="me_vlfo" value="{{ $noonReport->me_vlfo }}">
                        </div>
                        <div class="mb-3">
                            <label for="me_mdo" class="form-label">ME MDO</label>
                            <input type="number" step="0.1" class="form-control" id="me_mdo" name="me_mdo" value="{{ $noonReport->me_mdo }}">
                        </div>
                        <div class="mb-3">
                            <label for="me_lsmgo" class="form-label">ME LSMGO</label>
                            <input type="number" step="0.1" class="form-control" id="me_lsmgo" name="me_lsmgo" value="{{ $noonReport->me_lsmgo }}">
                        </div>
                        <h5>Auxiliary Engine Fuel Consumption (tonnes)</h5>
                        <div class="mb-3">
                            <label for="ae_hsfo" class="form-label">AE HSFO</label>
                            <input type="number" step="0.1" class="form-control" id="ae_hsfo" name="ae_hsfo" value="{{ $noonReport->ae_hsfo }}">
                        </div>
                        <div class="mb-3">
                            <label for="ae_lsfo" class="form-label">AE LSFO</label>
                            <input type="number" step="0.1" class="form-control" id="ae_lsfo" name="ae_lsfo" value="{{ $noonReport->ae_lsfo }}">
                        </div>
                        <div class="mb-3">
                            <label for="ae_vlfo" class="form-label">AE VLFO</label>
                            <input type="number" step="0.1" class="form-control" id="ae_vlfo" name="ae_vlfo" value="{{ $noonReport->ae_vlfo }}">
                        </div>
                        <div class="mb-3">
                            <label for="ae_mdo" class="form-label">AE MDO</label>
                            <input type="number" step="0.1" class="form-control" id="ae_mdo" name="ae_mdo" value="{{ $noonReport->ae_mdo }}">
                        </div>
                        <div class="mb-3">
                            <label for="ae_lsmgo" class="form-label">AE LSMGO</label>
                            <input type="number" step="0.1" class="form-control" id="ae_lsmgo" name="ae_lsmgo" value="{{ $noonReport->ae_lsmgo }}">
                        </div>
                        <h5>Boiler Fuel Consumption (tonnes)</h5>
                        <div class="mb-3">
                            <label for="boiler_hsfo" class="form-label">Boiler HSFO</label>
                            <input type="number" step="0.1" class="form-control" id="boiler_hsfo" name="boiler_hsfo" value="{{ $noonReport->boiler_hsfo }}">
                        </div>
                        <div class="mb-3">
                            <label for="boiler_lsfo" class="form-label">Boiler LSFO</label>
                            <input type="number" step="0.1" class="form-control" id="boiler_lsfo" name="boiler_lsfo" value="{{ $noonReport->boiler_lsfo }}">
                        </div>
                        <div class="mb-3">
                            <label for="boiler_vlfo" class="form-label">Boiler VLFO</label>
                            <input type="number" step="0.1" class="form-control" id="boiler_vlfo" name="boiler_vlfo" value="{{ $noonReport->boiler_vlfo }}">
                        </div>
                        <div class="mb-3">
                            <label for="boiler_mdo" class="form-label">Boiler MDO</label>
                            <input type="number" step="0.1" class="form-control" id="boiler_mdo" name="boiler_mdo" value="{{ $noonReport->boiler_mdo }}">
                        </div>
                        <div class="mb-3">
                            <label for="boiler_lsmgo" class="form-label">Boiler LSMGO</label>
                            <input type="number" step="0.1" class="form-control" id="boiler_lsmgo" name="boiler_lsmgo" value="{{ $noonReport->boiler_lsmgo }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Step 5: ETA & Remarks -->
        <div class="step-content" id="step5" style="display:none;">
            <div class="card mb-3">
                <div class="card-header"><h4>Step 5: ETA & Remarks</h4></div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="eta_final_destination" class="form-label">ETA Final Destination</label>
                            <input type="datetime-local" class="form-control" id="eta_final_destination" name="eta_final_destination" value="{{ $noonReport->eta_final_destination }}">
                        </div>
                        <div class="mb-3">
                            <label for="deviations" class="form-label">Deviations</label>
                            <textarea class="form-control" id="deviations" name="deviations" rows="2">{{ $noonReport->deviations }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="2">{{ $noonReport->remarks }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(-1)" style="display:none;">Previous</button>
                <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">Next</button>
                <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
@push('js')
<script>
let currentStep = 1;
const totalSteps = 5;
function showStep(step) {
    for (let i = 1; i <= totalSteps; i++) {
        document.getElementById('step' + i).style.display = (i === step) ? '' : 'none';
    }
    document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-block';
    document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'inline-block';
    document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-block' : 'none';
}
function changeStep(direction) {
    if (direction === 1 && currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
    } else if (direction === -1 && currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}
document.addEventListener('DOMContentLoaded', function() {
    showStep(1);
});
</script>
@endpush
