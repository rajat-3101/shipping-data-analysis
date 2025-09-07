@extends('adminlte::page')
@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">EU ETS Data</h2>
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Vessel</th>
                            <th>Voyage</th>
                            <th>Emission (MT)</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($euEtsData as $i => $row)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $row['vessel'] }}</td>
                                <td>{{ $row['voyage'] }}</td>
                                <td>{{ $row['emission'] }}</td>
                                <td>{{ $row['date'] }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No data found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
