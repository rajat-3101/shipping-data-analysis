@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Vessels</h1>
    <a href="{{ route('vessel-management.create') }}" class="btn btn-primary mb-3">Add New Vessel</a>
    <table class="table table-bordered" id="vessels-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Organization</th>
                <th>IMO Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vessels as $vessel)
                <tr>
                    <td>{{ $vessel->id }}</td>
                    <td>{{ $vessel->vessel_name }}</td>
                    <td>{{ $vessel->organization->name ?? '-' }}</td>
                    <td>{{ $vessel->imo_no }}</td>
                    <td>
                        <a href="{{ route('vessel-management.edit', $vessel->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('vessel-management.destroy', $vessel->id) }}" method="POST" style="display:inline-block;">
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
        $('#vessels-table').DataTable({
            "responsive": true,
            "autoWidth": false,
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[0, "desc"]], // Sort by ID descending by default
            "columnDefs": [
                {
                    "targets": -1, // Last column (Actions)
                    "orderable": false, // Disable sorting for Actions column
                    "searchable": false
                }
            ]
        });
    });
</script>
@endpush
