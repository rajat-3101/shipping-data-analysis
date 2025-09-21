@extends('adminlte::page')
@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Vessel Monitoring</h2>
    <div class="card shadow mb-4" style="max-width: 900px; margin: 0 auto;">
        <div class="card-body">
            <form method="GET" action="{{ route('vessel-monitoring.index') }}" id="monitoringForm">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <label for="vessel_id" class="form-label">Select Vessel:</label>
                        <select name="vessel_id" id="vessel_id" class="form-control" required>
                            <option value="">Select Vessel</option>
                            @foreach($vessels as $vessel)
                                <option value="{{ $vessel->id }}" {{ $selectedVessel == $vessel->id ? 'selected' : '' }}>{{ $vessel->vessel_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="voyage_id" class="form-label">Select Voyage:</label>
                        <select name="voyage_id" id="voyage_id" class="form-control" {{ empty($voyages) ? 'disabled' : '' }} required>
                            <option value="">Select Voyage</option>
                            @foreach($voyages as $voyage)
                                <option value="{{ $voyage->id }}" {{ $selectedVoyage == $voyage->id ? 'selected' : '' }}>{{ $voyage->voyage_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow" style="max-width: 900px; margin: 0 auto;">
        <div class="card-body">
            <table class="table table-bordered" id="monitoring-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Report Date</th>
                        <th>Rreport Time (UTC)</th>
                        <th>Vessel</th>
                        <th>Voyage</th>
                        <th>Created By</th>
                        <th>Report Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($noonReports as $report)
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($report->report_date)->format('Y-m-d') }}</td>
                            <td>{{\Carbon\Carbon::parse($report->report_date)->format('h:i A') }}</td>
                            <td>{{ $report->vessel->vessel_name ?? '-' }}</td>
                            <td>{{ $report->voyage->voyage_name ?? '-' }}</td>
                            <td>{{ $report->createdBy->name ?? '-' }}</td>
                            <td>{{ $report->reportType->report_name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('noon-report.show', $report->id) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const vesselSelect = document.getElementById('vessel_id');
        const voyageSelect = document.getElementById('voyage_id');
        vesselSelect.addEventListener('change', function() {
            const vesselId = this.value;
            voyageSelect.innerHTML = '<option value="">Loading...</option>';
            fetch(`/vessel-monitoring/voyages?vessel_id=${vesselId}`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Select Voyage</option>';
                    data.forEach(function(voyage) {
                        options += `<option value="${voyage.id}">${voyage.voyage_name}</option>`;
                    });
                    voyageSelect.innerHTML = options;
                    voyageSelect.disabled = false;
                });
        });
        voyageSelect.addEventListener('change', function() {
            document.getElementById('monitoringForm').submit();
        });
    });
</script>
@push('js')
<script>
    $(document).ready(function() {
        $('#monitoring-table').DataTable({
            "responsive": true,
            "autoWidth": false,
            "pageLength": 10,
            "order": [[0, "desc"]],
            "columnDefs": [
                { "targets": -1, "orderable": false, "searchable": false }
            ]
        });
    });
</script>
@endpush
@endsection
