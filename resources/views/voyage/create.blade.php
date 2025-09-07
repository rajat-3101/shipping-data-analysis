@extends('adminlte::page')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow w-100" style="max-width: 1100px;">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Add Voyage</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('voyage.store') }}" method="POST">
                @csrf
                <div class="row g-2"> <!-- Reduced gap for less vertical space -->
                    <div class="col-md-6">
                        <div class="mb-2"> <!-- Reduced margin for less vertical space -->
                            <label for="vessel_id" class="form-label">Vessel <span class="text-danger">*</span></label>
                            <select name="vessel_id" id="vessel_id" class="form-control" required>
                                <option value="">Select Vessel</option>
                                @foreach($vessels as $vessel)
                                    <option value="{{ $vessel->id }}">{{ $vessel->vessel_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="voyage_name" class="form-label">Voyage Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="voyage_name" name="voyage_name" required>
                        </div>
                        <div class="mb-2">
                            <label for="voyage_status" class="form-label">Status</label>
                            <select name="voyage_status" id="voyage_status" class="form-control">
                                <option value="0">Planned</option>
                                <option value="1">In Progress</option>
                                <option value="2">Completed</option>
                                <option value="3">Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="port_of_loading" class="form-label">Port of Loading</label>
                            <input type="text" class="form-control" id="port_of_loading" name="port_of_loading" required>
                        </div>
                        <div class="mb-2">
                            <label for="loading_port_eu" class="form-label">Loading Port in EU</label>
                            <select name="loading_port_eu" id="loading_port_eu" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="port_of_discharge" class="form-label">Port of Discharge</label>
                            <input type="text" class="form-control" id="port_of_discharge" name="port_of_discharge" required>
                        </div>
                        <div class="mb-2">
                            <label for="discharge_port_eu" class="form-label">Discharge Port in EU</label>
                            <select name="discharge_port_eu" id="discharge_port_eu" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="departure" class="form-label">Departure</label>
                            <input type="datetime-local" class="form-control" id="departure" name="departure">
                        </div>
                        <div class="mb-2">
                            <label for="arrival" class="form-label">Arrival</label>
                            <input type="datetime-local" class="form-control" id="arrival" name="arrival">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="voyage_commenced_at" class="form-label">Voyage Commenced At (FAOP)</label>
                            <input type="datetime-local" class="form-control" id="voyage_commenced_at" name="voyage_commenced_at">
                        </div>
                        <div class="mb-2">
                            <label for="voyage_completed_at" class="form-label">Voyage Completed At</label>
                            <input type="datetime-local" class="form-control" id="voyage_completed_at" name="voyage_completed_at">
                        </div>
                        <div class="mb-2">
                            <label for="planned_distance" class="form-label">Planned Distance (NM)</label>
                            <input type="number" step="0.01" class="form-control" id="planned_distance" name="planned_distance">
                        </div>
                        <div class="mb-2">
                            <label for="planned_speed" class="form-label">Planned Speed (Knots)</label>
                            <input type="number" step="0.01" class="form-control" id="planned_speed" name="planned_speed">
                        </div>
                        <div class="mb-2">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-3">
                    <button type="submit" class="btn btn-success px-4">Add Voyage</button>
                    <a href="{{ route('voyage.index') }}" class="btn btn-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
