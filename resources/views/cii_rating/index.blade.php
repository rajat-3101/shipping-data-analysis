@extends('adminlte::page')
@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">CII Ratings for All Vessels</h2>
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Vessel Name</th>
                            <th>IMO No.</th>
                            <th>Category</th>
                            <th>Deadweight (DWT)</th>
                            <th>CII Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vessels as $i => $vessel)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $vessel->vessel_name }}</td>
                                <td>{{ $vessel->imo_no }}</td>
                                <td>{{ $vessel->vesselCategory->name ?? '-' }}</td>
                                <td>{{ $vessel->dwt }}</td>
                                <td>
                                    @php
                                        $rating = $vessel->cii_rating ?? '-';
                                    @endphp
                                    <span class="badge 
                                        @if($rating=='A') bg-success
                                        @elseif($rating=='B') bg-primary
                                        @elseif($rating=='C') bg-info text-dark
                                        @elseif($rating=='D') bg-warning text-dark
                                        @elseif($rating=='E') bg-danger
                                        @else bg-secondary
                                        @endif
                                    ">
                                        {{ $rating }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">No vessels found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
