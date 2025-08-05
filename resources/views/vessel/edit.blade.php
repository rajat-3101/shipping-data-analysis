@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Edit Vessel</h1>
    <form action="{{ route('vessel-management.update', $vessel->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="Organization_id" class="form-label">Organization</label>
                    <select name="Organization_id" id="Organization_id" class="form-control" required>
                        <option value="">Select Organization</option>
                        @foreach($Organizations as $org)
                            <option value="{{ $org->id }}" {{ $vessel->Organization_id == $org->id ? 'selected' : '' }}>{{ $org->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="vessel_name" class="form-label">Vessel Name</label>
                    <input type="text" class="form-control" id="vessel_name" name="vessel_name" value="{{ $vessel->vessel_name }}" required>
                </div>
                <div class="mb-3">
                    <label for="flag" class="form-label">Flag (Country)</label>
                    <select name="flag" id="flag" class="form-control" required>
                        <option value="">Select Country</option>
                        @foreach(config('adminlte.countries', ['India', 'USA', 'UK', 'Singapore', 'Greece', 'Japan', 'China', 'Other']) as $country)
                            <option value="{{ $country }}" {{ $vessel->flag == $country ? 'selected' : '' }}>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="vessel_type" class="form-label">Vessel Type</label>
                    <select name="vessel_type" id="vessel_type" class="form-control" required>
                        <option value="">Select Type</option>
                        <option value="Bulk Carrier" {{ $vessel->vessel_type == 'Bulk Carrier' ? 'selected' : '' }}>Bulk Carrier</option>
                        <option value="Container vessel" {{ $vessel->vessel_type == 'Container vessel' ? 'selected' : '' }}>Container vessel</option>
                        <option value="Tanker" {{ $vessel->vessel_type == 'Tanker' ? 'selected' : '' }}>Tanker</option>
                        <option value="General Cargo" {{ $vessel->vessel_type == 'General Cargo' ? 'selected' : '' }}>General Cargo</option>
                        <option value="Passenger vessel" {{ $vessel->vessel_type == 'Passenger vessel' ? 'selected' : '' }}>Passenger vessel</option>
                        <option value="Ro-Ro" {{ $vessel->vessel_type == 'Ro-Ro' ? 'selected' : '' }}>Ro-Ro</option>
                        <option value="Other" {{ $vessel->vessel_type == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="imo_no" class="form-label">IMO No.</label>
                    <input type="text" class="form-control" id="imo_no" name="imo_no" value="{{ $vessel->imo_no }}">
                </div>
                <div class="mb-3">
                    <label for="owner" class="form-label">Owner</label>
                    <input type="text" class="form-control" id="owner" name="owner" value="{{ $vessel->owner }}">
                </div>
                <div class="mb-3">
                    <label for="commercial_manager" class="form-label">Operation Manager</label>
                    <input type="text" class="form-control" id="commercial_manager" name="commercial_manager" value="{{ $vessel->commercial_manager }}">
                </div>
                <div class="mb-3">
                    <label for="technical_manager" class="form-label">Technical Manager</label>
                    <input type="text" class="form-control" id="technical_manager" name="technical_manager" value="{{ $vessel->technical_manager }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="dwt" class="form-label">Deadweight Ton (DWT)</label>
                    <input type="number" class="form-control" id="dwt" name="dwt" step="0.01" value="{{ $vessel->dwt }}">
                </div>
                <div class="mb-3">
                    <label for="gt" class="form-label">Gross Ton (GT)</label>
                    <input type="number" class="form-control" id="gt" name="gt" step="0.01" value="{{ $vessel->gt }}">
                </div>
                <div class="mb-3">
                    <label for="nt" class="form-label">Net Ton (NT)</label>
                    <input type="number" class="form-control" id="nt" name="nt" step="0.01" value="{{ $vessel->nt }}">
                </div>
                <div class="mb-3">
                    <label for="cargo_unit" class="form-label">Cargo Unit</label>
                    <select name="cargo_unit" id="cargo_unit" class="form-control">
                        <option value="">Select Unit</option>
                        <option value="TEU" {{ $vessel->cargo_unit == 'TEU' ? 'selected' : '' }}>TEU</option>
                        <option value="MT" {{ $vessel->cargo_unit == 'MT' ? 'selected' : '' }}>MT</option>
                        <option value="CBM" {{ $vessel->cargo_unit == 'CBM' ? 'selected' : '' }}>CBM</option>
                        <option value="Other" {{ $vessel->cargo_unit == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date_of_delivery" class="form-label">Date of Delivery</label>
                    <input type="date" class="form-control" id="date_of_delivery" name="date_of_delivery" value="{{ $vessel->date_of_delivery }}">
                </div>
                <div class="mb-3">
                    <label for="call_sign" class="form-label">Call Sign</label>
                    <input type="text" class="form-control" id="call_sign" name="call_sign" value="{{ $vessel->call_sign }}">
                </div>
                <div class="mb-3">
                    <label for="mmsi" class="form-label">MMSI</label>
                    <input type="text" class="form-control" id="mmsi" name="mmsi" value="{{ $vessel->mmsi }}">
                </div>
                <div class="mb-3">
                    <label for="yard" class="form-label">Delivery Yard</label>
                    <input type="text" class="form-control" id="yard" name="yard" value="{{ $vessel->yard }}">
                </div>
                <div class="mb-3">
                    <label for="port_of_registry" class="form-label">Port of Registry</label>
                    <input type="text" class="form-control" id="port_of_registry" name="port_of_registry" value="{{ $vessel->port_of_registry }}">
                </div>
                <div class="mb-3">
                    <label for="hull_no" class="form-label">Hull No.</label>
                    <input type="text" class="form-control" id="hull_no" name="hull_no" value="{{ $vessel->hull_no }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="loa" class="form-label">LOA (Length Overall)</label>
                    <input type="text" class="form-control" id="loa" name="loa" value="{{ $vessel->loa }}">
                </div>
                <div class="mb-3">
                    <label for="lbp" class="form-label">LBP (Length Between Perpendiculars)</label>
                    <input type="text" class="form-control" id="lbp" name="lbp" value="{{ $vessel->lbp }}">
                </div>
                <div class="mb-3">
                    <label for="breadth" class="form-label">Breadth</label>
                    <input type="text" class="form-control" id="breadth" name="breadth" value="{{ $vessel->breadth }}">
                </div>
                <div class="mb-3">
                    <label for="depth" class="form-label">Depth</label>
                    <input type="text" class="form-control" id="depth" name="depth" value="{{ $vessel->depth }}">
                </div>
                <div class="mb-3">
                    <label for="draft" class="form-label">Draft</label>
                    <input type="text" class="form-control" id="draft" name="draft" value="{{ $vessel->draft }}">
                </div>
                <div class="mb-3">
                    <label for="full_displacement" class="form-label">Full Displacement</label>
                    <input type="text" class="form-control" id="full_displacement" name="full_displacement" value="{{ $vessel->full_displacement }}">
                </div>
                <div class="mb-3">
                    <label for="lightvessel_weight" class="form-label">Lightvessel Weight</label>
                    <input type="text" class="form-control" id="lightvessel_weight" name="lightvessel_weight" value="{{ $vessel->lightvessel_weight }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="cruising_range_miles" class="form-label">Cruising Range (Miles)</label>
                    <input type="text" class="form-control" id="cruising_range_miles" name="cruising_range_miles" value="{{ $vessel->cruising_range_miles }}">
                </div>
                <div class="mb-3">
                    <label for="cruising_range_days" class="form-label">Cruising Range (Days)</label>
                    <input type="text" class="form-control" id="cruising_range_days" name="cruising_range_days" value="{{ $vessel->cruising_range_days }}">
                </div>
                <div class="mb-3">
                    <label for="sea_trial_knots" class="form-label">Sea Trial Speed (Knots)</label>
                    <input type="text" class="form-control" id="sea_trial_knots" name="sea_trial_knots" value="{{ $vessel->sea_trial_knots }}">
                </div>
                <div class="mb-3">
                    <label for="sea_trial_draft" class="form-label">Sea Trial Draft</label>
                    <input type="text" class="form-control" id="sea_trial_draft" name="sea_trial_draft" value="{{ $vessel->sea_trial_draft }}">
                </div>
                <div class="mb-3">
                    <label for="service_knots" class="form-label">Service Speed (Knots)</label>
                    <input type="text" class="form-control" id="service_knots" name="service_knots" value="{{ $vessel->service_knots }}">
                </div>
                <div class="mb-3">
                    <label for="ballast" class="form-label">Ballast</label>
                    <input type="text" class="form-control" id="ballast" name="ballast" value="{{ $vessel->ballast }}">
                </div>
                <div class="mb-3">
                    <label for="laden" class="form-label">Laden</label>
                    <input type="text" class="form-control" id="laden" name="laden" value="{{ $vessel->laden }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="next_special_survey" class="form-label">Dry Dock</label>
                    <input type="text" class="form-control" id="next_special_survey" name="next_special_survey" value="{{ $vessel->next_special_survey }}">
                </div>
                <div class="mb-3">
                    <label for="cargo_capacity" class="form-label">Cargo Capacity</label>
                    <input type="text" class="form-control" id="cargo_capacity" name="cargo_capacity" value="{{ $vessel->cargo_capacity }}">
                </div>
                <div class="mb-3">
                    <label for="specifications" class="form-label">Vessel Specifications (Optional)</label>
                    <textarea class="form-control" id="specifications" name="specifications" rows="3">{{ $vessel->specifications }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{-- Fuel oil type (multiple select checkbox) --}}
                <div class="mb-4">
                    <label class="form-label"><strong>Fuel Oil Type</strong></label>
                    <div class="row">
                        @php $selectedFuels = is_array($vessel->fuel_oil_type) ? $vessel->fuel_oil_type : json_decode($vessel->fuel_oil_type, true) ?? []; @endphp
                        @foreach($fuelOilTypes->chunk(ceil($fuelOilTypes->count()/3)) as $chunk)
                            <div class="col-md-4">
                                @foreach($chunk as $fuel)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fuel_oil_type[]" value="{{ $fuel->name }}" id="fuel_{{ Str::slug($fuel->name, '_') }}" {{ in_array($fuel->name, $selectedFuels) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="fuel_{{ Str::slug($fuel->name, '_') }}">{{ $fuel->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- Lubricating oil type (multiple select checkbox) --}}
                <div class="mb-4">
                    <label class="form-label"><strong>Lubricating Oil Type</strong></label>
                    <div class="row">
                        @php $selectedLubes = is_array($vessel->lubricating_oil_type) ? $vessel->lubricating_oil_type : json_decode($vessel->lubricating_oil_type, true) ?? []; @endphp
                        @foreach($lubricatingOilTypes->chunk(ceil($lubricatingOilTypes->count()/2)) as $chunk)
                            <div class="col-md-6">
                                @foreach($chunk as $lube)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="lubricating_oil_type[]" value="{{ $lube->name }}" id="lubricating_{{ Str::slug($lube->name, '_') }}" {{ in_array($lube->name, $selectedLubes) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="lubricating_{{ Str::slug($lube->name, '_') }}">{{ $lube->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- Machinery (multiple select checkbox) --}}
                <div class="mb-4">
                    <label class="form-label"><strong>Machinery</strong></label>
                    <div class="row">
                        @php $selectedMachinery = is_array($vessel->machinery) ? $vessel->machinery : json_decode($vessel->machinery, true) ?? []; @endphp
                        @foreach($machineryTypes->chunk(ceil($machineryTypes->count()/2)) as $chunk)
                            <div class="col-md-6">
                                @foreach($chunk as $machinery)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="machinery[]" value="{{ $machinery->name }}" id="machinery_{{ Str::slug($machinery->name, '_') }}" {{ in_array($machinery->name, $selectedMachinery) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="machinery_{{ Str::slug($machinery->name, '_') }}">{{ $machinery->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('vessel-management.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
