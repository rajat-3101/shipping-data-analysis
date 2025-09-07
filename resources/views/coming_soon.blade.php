@extends('adminlte::page')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/595/595067.png" alt="Coming Soon" style="width:120px; margin-bottom: 24px;">
        <h1 class="display-4 mb-3">Coming Soon!</h1>
        <p class="lead mb-4">This feature is under development and will be available soon.<br>Stay tuned for updates.</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
    </div>
</div>
@endsection
