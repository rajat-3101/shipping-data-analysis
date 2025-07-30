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
                        @foreach($organizations as $org)
                            <option value="{{ $org->id }}" {{ $vessel->Organization_id == $org->id ? 'selected
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('vessel-management.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
