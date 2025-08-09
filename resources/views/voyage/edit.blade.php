@extends('adminlte::page')
@section('content')
<div class="container">
    <h1>Edit Voyage</h1>
    <form action="{{ route('voyage.update', $voyage->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="vessel_id" class="form-label">Vessel <span class="text-danger">*</span></label>
                    <select name="vessel_id" id="vessel_id" class="form-control" required>
                        <option value="">Select Vessel</option>
                        @foreach($vessels as $vessel)
                            <option value="{{ $vessel->id }}" {{ $voyage->vessel_id == $vessel->id ? 'selected' : '' }}>{{ $vessel->vessel_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="voyage_status" class="form-label">Status</label>
                    <select name="voyage_status" id="voyage_status" class="form-control">
                        <option value="0" {{ $voyage->voyage_status == 0 ? 'selected' : '' }}>Planned</option>
                        <option value="1" {{ $voyage->voyage_status == 1 ? 'selected' : '' }}>In Progress</option>
                        <option value="2" {{ $voyage->voyage_status == 2 ? 'selected' : '' }}>Completed</option>
                        <option value="3" {{ $voyage->voyage_status == 3 ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="port_of_loading" class="form-label">Port of Loading</label>
                    <input type="text" class="form-control" id="port_of_loading" name="port_of_loading" value="{{ $voyage->port_of_loading }}" required>
                </div>
                <div class="mb-3">
                    <label for="port_of_discharge" class="form-label">Port of Discharge</label>
                    <input type="text" class="form-control" id="port_of_discharge" name="port_of_discharge" value="{{ $voyage->port_of_discharge }}" required>
                </div>
                <div class="mb-3">
                    <label for="departure" class="form-label">Departure</label>
                    <input type="datetime-local" class="form-control" id="departure" name="departure" value="{{ $voyage->departure ? date('Y-m-d\TH:i', strtotime($voyage->departure)) : '' }}">
                </div>
                <div class="mb-3">
                    <label for="arrival" class="form-label">Arrival</label>
                    <input type="datetime-local" class="form-control" id="arrival" name="arrival" value="{{ $voyage->arrival ? date('Y-m-d\TH:i', strtotime($voyage->arrival)) : '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="voyage_commenced_at" class="form-label">Voyage Commenced At (FAOP)</label>
                    <input type="datetime-local" class="form-control" id="voyage_commenced_at" name="voyage_commenced_at" value="{{ $voyage->voyage_commenced_at ? date('Y-m-d\TH:i', strtotime($voyage->voyage_commenced_at)) : '' }}">
                </div>
                <div class="mb-3">
                    <label for="voyage_completed_at" class="form-label">Voyage Completed At</label>
                    <input type="datetime-local" class="form-control" id="voyage_completed_at" name="voyage_completed_at" value="{{ $voyage->voyage_completed_at ? date('Y-m-d\TH:i', strtotime($voyage->voyage_completed_at)) : '' }}">
                </div>
                <div class="mb-3">
                    <label for="planned_distance" class="form-label">Planned Distance (NM)</label>
                    <input type="number" step="0.01" class="form-control" id="planned_distance" name="planned_distance" value="{{ $voyage->planned_distance }}">
                </div>
                <div class="mb-3">
                    <label for="planned_speed" class="form-label">Planned Speed (Knots)</label>
                    <input type="number" step="0.01" class="form-control" id="planned_speed" name="planned_speed" value="{{ $voyage->planned_speed }}">
                </div>
                <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" id="remarks" name="remarks" rows="3">{{ $voyage->remarks }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="voyage_name" class="form-label">Voyage Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="voyage_name" name="voyage_name" value="{{ $voyage->voyage_name }}" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Update Voyage</button>
        <a href="{{ route('voyage.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
