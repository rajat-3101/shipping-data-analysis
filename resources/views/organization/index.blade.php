@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Organizations</h1>
    <a href="{{ route('organization-management.create') }}" class="btn btn-primary mb-3">Add New Client</a>
    
    <table class="table table-bordered table-striped" id="organizations-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Creation Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($organizations as $organization)
                <tr>
                    <td>{{ $organization->id }}</td>
                    <td>{{ $organization->name }}</td>
                    <td>{{ $organization->email }}</td>
                    <td>{{ $organization->contact_number }}</td>
                    <td>{{ optional($organization->created_at)->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('organization-management.edit', $organization->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('organization-management.destroy', $organization->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this organization?')">Delete</button>
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
        $('#organizations-table').DataTable({
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