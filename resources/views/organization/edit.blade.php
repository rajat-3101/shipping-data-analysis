@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Edit Organization</h1>
    <form action="{{ route('Organization-management.update', $Organization->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $Organization->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $Organization->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('Organization-management.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
