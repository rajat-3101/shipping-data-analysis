@extends('adminlte::page')

@section('title','Organization')

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Client</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('organization-management.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Organization Name</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Enter organization name">
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country of Registration</label>
                    <input type="text" class="form-control" id="country" name="country" required placeholder="E.g. United States, Germany, India">
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">Official Website</label>
                    <input type="url" class="form-control" id="website" name="website" placeholder="https://example.org">
                </div>

                <div class="mb-3">
                    <label for="contact_email" class="form-label">Contact Email</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Contact Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="+1-123-456-7890">
                </div>

                <button type="submit" class="btn btn-success">Register Organization</button>
            </form>
        </div>
    </div>
</div>

@stop
@section('js')
  {{-- <script src="{{ mix('js/admin-panel/categories_management.js')}}" type="text/javascript"></script> --}}
@endsection

