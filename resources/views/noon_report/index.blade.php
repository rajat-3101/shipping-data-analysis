@extends('adminlte::page')
@section('content')
<div class="container">
    <h1>Noon Reports</h1>
    <a href="{{ route('noon-report.create') }}" class="btn btn-primary mb-3">Add Noon Report</a>
    <a href="{{ route('report-upload.create') }}" class="btn btn-success mb-3 ms-2">Upload Report</a>
    <table class="table table-bordered" id="noon-reports-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vessel</th>
                <th>Voyage</th>
                <th>Date</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($noonReports as $report)
                <tr>
                    {{-- {{ dd($report->createdBy->name) }} --}}
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->vessel->vessel_name ?? '-' }}</td>
                    <td>{{ $report->voyage->voyage_name ?? '-' }}</td>
                    <td>{{ $report->report_date }}</td>
                    <td>{{ $report->createdBy->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('noon-report.edit', $report->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('noon-report.destroy', $report->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('#noon-reports-table').DataTable({
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
