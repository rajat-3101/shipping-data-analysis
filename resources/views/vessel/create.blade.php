@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Onboard Vessel</h2>
    
    <!-- Progress Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="progress" style="height: 8px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="progressBar"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <small class="text-muted step-label active" id="step1Label">Basic Info</small>
                <small class="text-muted step-label" id="step2Label">Technical Details</small>
                <small class="text-muted step-label" id="step3Label">Specifications</small>
                <small class="text-muted step-label" id="step4Label">Fuel & Machinery</small>
            </div>
        </div>
    </div>

    <form action="{{ route('vessel-management.store') }}" method="POST" id="vesselForm">
        @csrf

        <!-- Step 1: Basic Information -->
        <div class="step-content" id="step1">
            <div class="card">
                <div class="card-header">
                    <h4>Step 1: Basic Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Organization ID as dropdown --}}
                            <div class="mb-3">
                                <label for="Organization_id" class="form-label">Organization <span class="text-danger">*</span></label>
                                <select name="Organization_id" id="Organization_id" class="form-control" required>
                                    <option value="">Select Organization</option>
                                    @foreach($Organizations as $org)
                                        <option value="{{ $org->id }}">{{ $org->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Vessel Name --}}
                            <div class="mb-3">
                                <label for="vessel_name" class="form-label">Vessel Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="vessel_name" name="vessel_name" required>
                            </div>

                            {{-- Flag (Country dropdown) --}}
                            <div class="mb-3">
                                <label for="flag" class="form-label">Flag (Country) <span class="text-danger">*</span></label>
                                <select name="flag" id="flag" class="form-control" required>
                                    <option value="">Select Country</option>
                                    @foreach(config('adminlte.countries', ['India', 'USA', 'UK', 'Singapore', 'Greece', 'Japan', 'China', 'Other']) as $country)
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Vessel Type (dropdown) --}}
                            <div class="mb-3">
                                <label for="vessel_type" class="form-label">Vessel Type <span class="text-danger">*</span></label>
                                <select name="vessel_type" id="vessel_type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="Bulk Carrier">Bulk Carrier</option>
                                    <option value="Container vessel">Container vessel</option>
                                    <option value="Tanker">Tanker</option>
                                    <option value="General Cargo">General Cargo</option>
                                    <option value="Passenger vessel">Passenger vessel</option>
                                    <option value="Ro-Ro">Ro-Ro</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- IMO No. --}}
                            <div class="mb-3">
                                <label for="imo_no" class="form-label">IMO No.</label>
                                <input type="text" class="form-control" id="imo_no" name="imo_no">
                            </div>

                            {{-- Owner --}}
                            <div class="mb-3">
                                <label for="owner" class="form-label">Owner</label>
                                <input type="text" class="form-control" id="owner" name="owner">
                            </div>

                            {{-- Commercial Manager --}}
                            <div class="mb-3">
                                <label for="commercial_manager" class="form-label">Commercial Manager</label>
                                <input type="text" class="form-control" id="commercial_manager" name="commercial_manager">
                            </div>

                            {{-- Technical Manager --}}
                            <div class="mb-3">
                                <label for="technical_manager" class="form-label">Technical Manager</label>
                                <input type="text" class="form-control" id="technical_manager" name="technical_manager">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2: Technical Details -->
        <div class="step-content" id="step2" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h4>Step 2: Technical Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Deadweight Ton (DWT) --}}
                            <div class="mb-3">
                                <label for="dwt" class="form-label">Deadweight Ton (DWT)</label>
                                <input type="number" class="form-control" id="dwt" name="dwt" step="0.01">
                            </div>

                            {{-- Gross Ton (GT) --}}
                            <div class="mb-3">
                                <label for="gt" class="form-label">Gross Ton (GT)</label>
                                <input type="number" class="form-control" id="gt" name="gt" step="0.01">
                            </div>

                            {{-- Net Ton (NT) --}}
                            <div class="mb-3">
                                <label for="nt" class="form-label">Net Ton (NT)</label>
                                <input type="number" class="form-control" id="nt" name="nt" step="0.01">
                            </div>

                            {{-- Cargo unit (dropdown) --}}
                            <div class="mb-3">
                                <label for="cargo_unit" class="form-label">Cargo Unit</label>
                                <select name="cargo_unit" id="cargo_unit" class="form-control">
                                    <option value="">Select Unit</option>
                                    <option value="TEU">TEU</option>
                                    <option value="MT">MT</option>
                                    <option value="CBM">CBM</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            {{-- Date of Delivery --}}
                            <div class="mb-3">
                                <label for="date_of_delivery" class="form-label">Date of Delivery</label>
                                <input type="date" class="form-control" id="date_of_delivery" name="date_of_delivery">
                            </div>

                            {{-- Call Sign --}}
                            <div class="mb-3">
                                <label for="call_sign" class="form-label">Call Sign</label>
                                <input type="text" class="form-control" id="call_sign" name="call_sign">
                            </div>

                            {{-- MMSI --}}
                            <div class="mb-3">
                                <label for="mmsi" class="form-label">MMSI</label>
                                <input type="text" class="form-control" id="mmsi" name="mmsi">
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Yard --}}
                            <div class="mb-3">
                                <label for="yard" class="form-label">Yard</label>
                                <input type="text" class="form-control" id="yard" name="yard">
                            </div>

                            {{-- Port of Registry --}}
                            <div class="mb-3">
                                <label for="port_of_registry" class="form-label">Port of Registry</label>
                                <input type="text" class="form-control" id="port_of_registry" name="port_of_registry">
                            </div>

                            {{-- Hull No. --}}
                            <div class="mb-3">
                                <label for="hull_no" class="form-label">Hull No.</label>
                                <input type="text" class="form-control" id="hull_no" name="hull_no">
                            </div>

                            {{-- Next Special Survey/Dry Dock --}}
                            <div class="mb-3">
                                <label for="next_special_survey" class="form-label">Next Special Survey/Dry Dock</label>
                                <input type="text" class="form-control" id="next_special_survey" name="next_special_survey">
                            </div>

                            {{-- Cargo Capacity --}}
                            <div class="mb-3">
                                <label for="cargo_capacity" class="form-label">Cargo Capacity</label>
                                <input type="text" class="form-control" id="cargo_capacity" name="cargo_capacity">
                            </div>

                            {{-- vessel Specifications (Optional) --}}
                            <div class="mb-3">
                                <label for="specifications" class="form-label">vessel Specifications (Optional)</label>
                                <textarea class="form-control" id="specifications" name="specifications" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Physical Specifications -->
        <div class="step-content" id="step3" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h4>Step 3: Physical Specifications</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">Dimensions</h5>
                            
                            {{-- LOA --}}
                            <div class="mb-3">
                                <label for="loa" class="form-label">LOA (Length Overall)</label>
                                <input type="text" class="form-control" id="loa" name="loa">
                            </div>

                            {{-- LBP --}}
                            <div class="mb-3">
                                <label for="lbp" class="form-label">LBP (Length Between Perpendiculars)</label>
                                <input type="text" class="form-control" id="lbp" name="lbp">
                            </div>

                            {{-- Breadth --}}
                            <div class="mb-3">
                                <label for="breadth" class="form-label">Breadth</label>
                                <input type="text" class="form-control" id="breadth" name="breadth">
                            </div>

                            {{-- Depth --}}
                            <div class="mb-3">
                                <label for="depth" class="form-label">Depth</label>
                                <input type="text" class="form-control" id="depth" name="depth">
                            </div>

                            {{-- Draft --}}
                            <div class="mb-3">
                                <label for="draft" class="form-label">Draft</label>
                                <input type="text" class="form-control" id="draft" name="draft">
                            </div>

                            {{-- Full Displacement --}}
                            <div class="mb-3">
                                <label for="full_displacement" class="form-label">Full Displacement</label>
                                <input type="text" class="form-control" id="full_displacement" name="full_displacement">
                            </div>

                            {{-- Lightvessel Weight --}}
                            <div class="mb-3">
                                <label for="lightvessel_weight" class="form-label">Lightvessel Weight</label>
                                <input type="text" class="form-control" id="lightvessel_weight" name="lightvessel_weight">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Performance Specifications</h5>
                            
                            {{-- Cruising Range Miles --}}
                            <div class="mb-3">
                                <label for="cruising_range_miles" class="form-label">Cruising Range (Miles)</label>
                                <input type="text" class="form-control" id="cruising_range_miles" name="cruising_range_miles">
                            </div>

                            {{-- Cruising Range Days --}}
                            <div class="mb-3">
                                <label for="cruising_range_days" class="form-label">Cruising Range (Days)</label>
                                <input type="text" class="form-control" id="cruising_range_days" name="cruising_range_days">
                            </div>

                            {{-- Sea Trial (Knots) --}}
                            <div class="mb-3">
                                <label for="sea_trial_knots" class="form-label">Sea Trial Speed (Knots)</label>
                                <input type="text" class="form-control" id="sea_trial_knots" name="sea_trial_knots">
                            </div>

                            {{-- Sea Trial (Draft) --}}
                            <div class="mb-3">
                                <label for="sea_trial_draft" class="form-label">Sea Trial Draft</label>
                                <input type="text" class="form-control" id="sea_trial_draft" name="sea_trial_draft">
                            </div>

                            {{-- Service (Knots) --}}
                            <div class="mb-3">
                                <label for="service_knots" class="form-label">Service Speed (Knots)</label>
                                <input type="text" class="form-control" id="service_knots" name="service_knots">
                            </div>

                            {{-- Ballast --}}
                            <div class="mb-3">
                                <label for="ballast" class="form-label">Ballast</label>
                                <input type="text" class="form-control" id="ballast" name="ballast">
                            </div>

                            {{-- Laden --}}
                            <div class="mb-3">
                                <label for="laden" class="form-label">Laden</label>
                                <input type="text" class="form-control" id="laden" name="laden">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4: Fuel & Machinery -->
        <div class="step-content" id="step4" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h4>Step 4: Fuel & Machinery</h4>
                </div>
                <div class="card-body">
                    {{-- Fuel oil type (multiple select checkbox) --}}
                    <div class="mb-4">
                        <label class="form-label"><strong>Fuel Oil Type</strong></label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="LNG" id="fuel_lng">
                                    <label class="form-check-label" for="fuel_lng">LNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="HFO" id="fuel_hfo">
                                    <label class="form-check-label" for="fuel_hfo">HFO</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="LFO" id="fuel_lfo">
                                    <label class="form-check-label" for="fuel_lfo">LFO</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="MDO" id="fuel_mdo">
                                    <label class="form-check-label" for="fuel_mdo">MDO</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="MGO" id="fuel_mgo">
                                    <label class="form-check-label" for="fuel_mgo">MGO</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="LPG (Propane)" id="fuel_lpg_propane">
                                    <label class="form-check-label" for="fuel_lpg_propane">LPG (Propane)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="LPG (Butane)" id="fuel_lpg_butane">
                                    <label class="form-check-label" for="fuel_lpg_butane">LPG (Butane)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="Methanol" id="fuel_methanol">
                                    <label class="form-check-label" for="fuel_methanol">Methanol</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="Ethanol" id="fuel_ethanol">
                                    <label class="form-check-label" for="fuel_ethanol">Ethanol</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="B23" id="fuel_b23">
                                    <label class="form-check-label" for="fuel_b23">B23</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="Others" id="fuel_others">
                                    <label class="form-check-label" for="fuel_others">Others</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Lubricating oil type (multiple select checkbox) --}}
                    <div class="mb-4">
                        <label class="form-label"><strong>Lubricating Oil Type</strong></label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="lubricating_oil_type[]" value="M/E Cylinder Oil" id="lubricating_me_cylinder">
                                    <label class="form-check-label" for="lubricating_me_cylinder">M/E Cylinder Oil</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="lubricating_oil_type[]" value="M/E Cylinder Oil (Low Sulfur)" id="lubricating_me_cylinder_low">
                                    <label class="form-check-label" for="lubricating_me_cylinder_low">M/E Cylinder Oil (Low Sulfur)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="lubricating_oil_type[]" value="M/E System Oil" id="lubricating_me_system">
                                    <label class="form-check-label" for="lubricating_me_system">M/E System Oil</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="lubricating_oil_type[]" value="M/E Sump Tank" id="lubricating_me_sump">
                                    <label class="form-check-label" for="lubricating_me_sump">M/E Sump Tank</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="lubricating_oil_type[]" value="G/E System Oil" id="lubricating_ge_system">
                                    <label class="form-check-label" for="lubricating_ge_system">G/E System Oil</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="lubricating_oil_type[]" value="TG System Oil" id="lubricating_tg_system">
                                    <label class="form-check-label" for="lubricating_tg_system">TG System Oil</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="lubricating_oil_type[]" value="Others" id="lubricating_others">
                                    <label class="form-check-label" for="lubricating_others">Others</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Machinery (multiple select checkbox) --}}
                    <div class="mb-4">
                        <label class="form-label"><strong>Machinery</strong></label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="machinery[]" value="Main Engine" id="machinery_main_engine">
                                    <label class="form-check-label" for="machinery_main_engine">Main Engine</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="machinery[]" value="Generator Engine" id="machinery_generator_engine">
                                    <label class="form-check-label" for="machinery_generator_engine">Generator Engine</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="machinery[]" value="Boiler" id="machinery_boiler">
                                    <label class="form-check-label" for="machinery_boiler">Boiler</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="machinery[]" value="Inert Gas Generator" id="machinery_inert_gas">
                                    <label class="form-check-label" for="machinery_inert_gas">Inert Gas Generator</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="machinery[]" value="Incinerator" id="machinery_incinerator">
                                    <label class="form-check-label" for="machinery_incinerator">Incinerator</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="machinery[]" value="Gas Combustion Unit" id="machinery_gas_combustion">
                                    <label class="form-check-label" for="machinery_gas_combustion">Gas Combustion Unit</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="machinery[]" value="Others" id="machinery_others">
                                    <label class="form-check-label" for="machinery_others">Others</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(-1)" style="display: none;">Previous</button>
                    <div></div>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">Next</button>
                    <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">Add vessel</button>
                </div>
            </div>
        </div>
    </form>

    {{-- <div class="mt-3">
        <a href="{{ route('vessel-management.index') }}" class="btn btn-link">← Back to vessel List</a>
    </div> --}}
</div>

<style>
.step-label {
    font-weight: 500;
}
.step-label.active {
    color: #007bff !important;
    font-weight: 600;
}
.card {
    border: none;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
.card-header {
    background: linear-gradient(45deg, #007bff, #0056b3);
    color: white;
    border-radius: 0.375rem 0.375rem 0 0 !important;
}
.form-check {
    margin-bottom: 0.5rem;
}
.progress {
    border-radius: 10px;
}
.progress-bar {
    transition: width 0.3s ease;
}
</style>

<script>
let currentStep = 1;
const totalSteps = 4;

function showStep(step) {
    // Hide all steps
    for (let i = 1; i <= totalSteps; i++) {
        document.getElementById('step' + i).style.display = 'none';
        document.getElementById('step' + i + 'Label').classList.remove('active');
    }
    
    // Show current step
    document.getElementById('step' + step).style.display = 'block';
    document.getElementById('step' + step + 'Label').classList.add('active');
    
    // Update progress bar
    const progress = (step / totalSteps) * 100;
    document.getElementById('progressBar').style.width = progress + '%';
    document.getElementById('progressBar').setAttribute('aria-valuenow', progress);
    
    // Update navigation buttons
    document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-block';
    document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'inline-block';
    document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-block' : 'none';
}

function changeStep(direction) {
    if (direction === 1 && currentStep < totalSteps) {
        // Validate required fields in current step before proceeding
        if (validateCurrentStep()) {
            currentStep++;
            showStep(currentStep);
        }
    } else if (direction === -1 && currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

function validateCurrentStep() {
    if (currentStep === 1) {
        // Validate required fields in step 1
        const requiredFields = ['Organization_id', 'vessel_name', 'flag', 'vessel_type'];
        for (let field of requiredFields) {
            const element = document.getElementById(field);
            if (!element.value.trim()) {
                element.focus();
                alert('Please fill in all required fields marked with *');
                return false;
            }
        }
    }
    return true;
}

// Initialize the form
document.addEventListener('DOMContentLoaded', function() {
    showStep(1);
    
    // Add form submission handler
    document.getElementById('vesselForm').addEventListener('submit', function(e) {
        // You can add final validation here if needed
        console.log('Form submitted');
    });
});

// Allow Enter key to move to next step (except on textareas)
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA' && currentStep < totalSteps) {
        e.preventDefault();
        changeStep(1);
    }
});
</script>
@endsection