@extends('adminlte::page')
@section('content')
<div class="container">
    <h1>Add Noon Report</h1>
    <!-- Progress Bar -->
    <div class="progress mb-4" style="height: 30px; background: #e9ecef; border-radius: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div id="progressBar" class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar"
            style="width: 20%; font-weight: 600; font-size: 1.1rem; color: #fff; border-radius: 20px; transition: width 0.4s;"
            aria-valuenow="1" aria-valuemin="1" aria-valuemax="5">
            <span id="progressStep">Step 1</span> of 5
        </div>
    </div>
    <form action="{{ route('noon-report.store') }}" method="POST" id="noonReportForm">
        @csrf
        <!-- Step 1: Basic Info -->
        <div class="step-content" id="step1">
            <div class="card mb-3">
                <div class="card-header"><h4>Step 1: Basic Info</h4></div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="vessel_id" class="form-label">Vessel Name<span class="text-danger">*</span></label>
                            <select name="vessel_id" id="vessel_id" class="form-control" required>
                                <option value="">Select Vessel</option>
                                @foreach($vessels as $vessel)
                                    <option value="{{ $vessel->id }}">{{ $vessel->vessel_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="voyage_id" class="form-label">Voyage Name<span class="text-danger">*</span></label>
                            <select name="voyage_id" id="voyage_id" class="form-control">
                                <option value="">Select Voyage</option>
                                @foreach($voyages as $voyage)
                                    <option value="{{ $voyage->id }}">{{ $voyage->voyage_name }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="mb-3">
                            <label for="voyage_comes_under" class="form-label">Voyage Comes Under<span class="text-danger">*</span></label>
                            <select name="voyage_comes_under" id="voyage_comes_under" class="form-control">
                                <option value="">Select Voyage</option>
                                <option value="EU Port">EU Port</option>
                                <option value="EEA Port">EEA Port</option>
                                <option value="UK Port">UK Port</option>
                                <option value="Non EU Port">Non EU Port</option>
                                <option value="None of the above">None of the above </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="report_date" class="form-label">Report Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="report_date" name="report_date" required>
                        </div>
                       
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="utc_time" class="form-label">UTC Time<span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="utc_time" name="utc_time">
                        </div>
                        <div class="mb-3">
                            <label for="time_correction" class="form-label">Time Correction<span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="time_correction" name="time_correction">
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
                            <label for="position_lat" class="form-label">Latitude<span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" id="position_lat" name="position_lat">
                        </div>
                        <div class="mb-3">
                            <label for="position_long" class="form-label">Longitude<span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" id="position_long" name="position_long">
                        </div>
                        <div class="mb-3">
                            <label for="vessel_movement" class="form-label">Vessel Movement<span class="text-danger">*</span></label>
                            <select name="vessel_movement" id="vessel_movement" class="form-control">
                                <option value="At Sea">At Sea</option>
                                <option value="At Port">At Port</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="observed_distance_since_last" class="form-label">Observed Distance Since Last Noon Report(NM)<span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" id="observed_distance_since_last" name="observed_distance_since_last">
                        </div>
                        <div class="mb-3">
                            <label for="log_distance" class="form-label">Log Distance (NM)<span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" id="log_distance" name="log_distance">
                        </div>
                        <div class="mb-3">
                            <label for="engine_distance" class="form-label">Engine Distance (NM)<span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" id="engine_distance" name="engine_distance">
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
                            <label for="sog_slip" class="form-label">SOG Slip (%)<span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" id="sog_slip" name="sog_slip">
                        </div>
                        <div class="mb-3">
                            <label for="log_slip" class="form-label">Log Slip (%)</label>
                            <input type="number" step="any" class="form-control" id="log_slip" name="log_slip">
                        </div>
                        <div class="mb-3">
                            <label for="total_steaming_hours_since_faop" class="form-label">Total Steaming Hours Since FAOP</label>
                            <input type="number" step="any" class="form-control" id="total_steaming_hours_since_faop" name="total_steaming_hours_since_faop">
                        </div>
                        <div class="mb-3">
                            <label for="total_distance_since_faop" class="form-label">Total Distance Since FAOP (NM)</label>
                            <input type="number" step="any" class="form-control" id="total_distance_since_faop" name="total_distance_since_faop">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="distance_to_next_port" class="form-label">Distance to Next Port (NM)</label>
                            <input type="number" step="any" class="form-control" id="distance_to_next_port" name="distance_to_next_port">
                        </div> --}}
                        <div class="mb-3">
                            <label for="distance_to_destination_port" class="form-label">Distance to Destination Port (NM)</label>
                            <input type="number" step="any" class="form-control" id="distance_to_destination_port" name="distance_to_destination_port">
                        </div>
                        <div class="mb-3">
                            <label for="avg_speed_since_last_og" class="form-label">Avg Speed Since Last Noon Report (SOG) (Knots)</label>
                            <input type="number" step="any" class="form-control" id="avg_speed_since_last_og" name="avg_speed_since_last_og">
                        </div>
                        <div class="mb-3">
                            <label for="avg_speed_since_last_log" class="form-label">Avg Speed Since Last Noon Report (Log) (Knots)</label>
                            <input type="number" step="any" class="form-control" id="avg_speed_since_last_log" name="avg_speed_since_last_log">
                        </div>
                        <div class="mb-3">
                            <label for="average_engine_rpm_since_last_noon_report" class="form-label">Avg Engine RPM Since Last Noon Report</label>
                            <input type="number" step="any" class="form-control" id="average_engine_rpm_since_last_noon_report" name="average_engine_rpm_since_last_noon_report">
                        </div>
                        <div class="mb-3">
                            <label for="avg_rpm_since_faop" class="form-label">Avg RPM Since FAOP</label>
                            <input type="number" step="any" class="form-control" id="avg_rpm_since_faop" name="avg_rpm_since_faop">
                        </div>
                        <div class="mb-3">
                            <label for="engine_power" class="form-label">Engine Power (kW)</label>
                            <input type="number" step="any" class="form-control" id="engine_power" name="engine_power">
                        </div>
                        <div class="mb-3">
                            <label for="engine_torque" class="form-label">Engine Torque (kNm)</label>
                            <input type="number" step="any" class="form-control" id="engine_torque" name="engine_torque">
                        </div>
                         <div class="mb-3">
                            <label for="engine_load_percentage" class="form-label">Engine Load Percentage(%)</label>
                            <input type="number" step="any" class="form-control" id="engine_load_percentage" name="engine_load_percentage">
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
                            <input type="number" step="any" class="form-control" id="seawater_temp" name="seawater_temp">
                        </div>
                        <div class="mb-3">
                            <label for="atmosphere_temp" class="form-label">Atmosphere Temp (°C)</label>
                            <input type="number" step="any" class="form-control" id="atmosphere_temp" name="atmosphere_temp">
                        </div>
                        <div class="mb-3">
                            <label for="wind_direction" class="form-label">Wind Direction</label>
                            <select name="wind_direction" id="wind_direction" class="form-control">
                                <option value="">Select</option>
                                @foreach(['N','NNE','NE','ENE','E','ESE','SE','SSE','S','SSW','SW','WSW','W','WNW','NW','NNW'] as $dir)
                                    <option value="{{ $dir }}">{{ $dir }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="wind_relative_direction" class="form-label">Wind Relative Direction</label>
                            <select name="wind_relative_direction" id="wind_relative_direction" class="form-control">
                                <option value="">Select</option>
                                @foreach(['1','2','3','4','5','6','7','8'] as $rel)
                                    <option value="{{ $rel }}">{{ $rel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="wind_speed_knots" class="form-label">Wind Speed (knots)</label>
                            <input type="number" step="any" class="form-control" id="wind_speed_knots" name="wind_speed_knots">
                        </div>
                        <div class="mb-3">
                            <label for="sea_direction" class="form-label">Sea Direction (°)</label>
                            <input type="number" class="form-control" id="sea_direction" name="sea_direction">
                        </div>
                        <div class="mb-3">
                            <label for="sea_state" class="form-label">Sea State (0-9)</label>
                            <input type="number" min="0" max="9" class="form-control" id="sea_state" name="sea_state">
                        </div>
                        <div class="mb-3">
                            <label for="beaufort_force" class="form-label">Beaufort Force (0-12)</label>
                            <input type="number" min="0" max="12" step="any" class="form-control" id="beaufort_force" name="beaufort_force">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>ME Fuel Consumption Since Last Noon Report(tonnes)</h5>
                        <div class="mb-3">
                            <label for="me_hfo" class="form-label">ME HFO</label>
                            <input type="number" step="any" class="form-control" id="me_hfo" name="me_hfo">
                        </div>
                        <div class="mb-3">
                            <label for="me_lfo" class="form-label">ME LFO</label>
                            <input type="number" step="any" class="form-control" id="me_lfo" name="me_lfo">
                        </div>
                        <div class="mb-3">
                            <label for="me_vlsfo" class="form-label">ME VLSFO</label>
                            <input type="number" step="any" class="form-control" id="me_vlsfo" name="me_vlsfo">
                        </div>
                        <div class="mb-3">
                            <label for="me_mdo_mgo" class="form-label">ME MDO/MGO</label>
                            <input type="number" step="any" class="form-control" id="me_mdo_mgo" name="me_mdo_mgo">
                        </div>
                       
                        <h5>AE Fuel Consumption Since Last Noon Report(tonnes)</h5>
                        <div class="mb-3">
                            <label for="ae_hfo" class="form-label">AE HFO</label>
                            <input type="number" step="any" class="form-control" id="ae_hfo" name="ae_hfo">
                        </div>
                        <div class="mb-3">
                            <label for="ae_lfo" class="form-label">AE LFO</label>
                            <input type="number" step="any" class="form-control" id="ae_lfo" name="ae_lfo">
                        </div>
                        <div class="mb-3">
                            <label for="ae_vlsfo" class="form-label">AE VLSFO</label>
                            <input type="number" step="any" class="form-control" id="ae_vlsfo" name="ae_vlsfo">
                        </div>
                        <div class="mb-3">
                            <label for="ae_mdo_mgo" class="form-label">AE MDO/MGO</label>
                            <input type="number" step="any" class="form-control" id="ae_mdo_mgo" name="ae_mdo_mgo">
                        </div>
                        
                        <h5>Boiler Fuel Consumption Since Last Noon Report(tonnes)</h5>
                        <div class="mb-3">
                            <label for="boiler_hfo" class="form-label">Boiler HFO</label>
                            <input type="number" step="any" class="form-control" id="boiler_hfo" name="boiler_hfo">
                        </div>
                        <div class="mb-3">
                            <label for="boiler_lfo" class="form-label">Boiler LFO</label>
                            <input type="number" step="any" class="form-control" id="boiler_lfo" name="boiler_lfo">
                        </div>
                        <div class="mb-3">
                            <label for="boiler_vlsfo" class="form-label">Boiler VLSFO</label>
                            <input type="number" step="any" class="form-control" id="boiler_vlsfo" name="boiler_vlsfo">
                        </div>
                        <div class="mb-3">
                            <label for="boiler_mdo_mgo" class="form-label">Boiler MDO/MGO</label>
                            <input type="number" step="any" class="form-control" id="boiler_mdo_mgo" name="boiler_mdo_mgo">
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
                            <label for="eta_final_destination" class="form-label">ETA Destination Port</label>
                            <input type="datetime-local" class="form-control" id="eta_final_destination" name="eta_final_destination">
                        </div>
                        <div class="mb-3">
                            <label for="deviations" class="form-label">Deviations</label>
                            <textarea class="form-control" id="deviations" name="deviations" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="2"></textarea>
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
                <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">Submit</button>
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
        // Remove required from all inputs in hidden steps
        if (i !== step) {
            document.querySelectorAll('#step' + i + ' [required]').forEach(el => el.removeAttribute('required'));
        } else {
            // Add required back to visible step's required fields
            document.querySelectorAll('#step' + i + ' [data-always-required]').forEach(el => el.setAttribute('required', 'required'));
        }
    }
    document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-block';
    document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'inline-block';
    document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-block' : 'none';
    // Progress bar update
    const percent = Math.round((step / totalSteps) * 100);
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = percent + '%';
    progressBar.setAttribute('aria-valuenow', step);
    document.getElementById('progressStep').innerText = 'Step ' + step;
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
    // Mark all required fields with a data attribute
    document.querySelectorAll('[required]').forEach(el => el.setAttribute('data-always-required', '1'));
    showStep(1);
});
</script>
@endpush
