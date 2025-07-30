@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>vessels</h1>
    <a href="{{ route('vessel-management.create') }}" class="btn btn-primary mb-3">Add New vessel</a>
    <table class="table table-bordered" id="vessels-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vessels as $vessel)
                <tr>
                    <td>{{ $vessel->id }}</td>
                    <td>{{ $vessel->name }}</td>
                    <td>{{ $vessel->description }}</td>
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

@push('scripts')
<!-- DataTables JS and CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#vessels-table').DataTable();
    });
</script>
@endpush
