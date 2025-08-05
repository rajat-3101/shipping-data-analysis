@extends('adminlte::page')
@section('content')
<div class="container">
    <h1>Voyages</h1>
    <a href="{{ route('voyage.create') }}" class="btn btn-primary mb-3">Add Voyage</a>
    <table class="table table-bordered" id="voyages-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vessel</th>
                <th>Status</th>
                <th>Port of Loading</th>
                <th>Port of Discharge</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($voyages as $voyage)
                <tr>
                    <td>{{ $voyage->id }}</td>
                    <td>{{ $voyage->vessel->vessel_name ?? '-' }}</td>
                    <td>@php $statuses = ['Planned','In Progress','Completed','Cancelled']; @endphp {{ $statuses[$voyage->voyage_status] ?? '-' }}</td>
                    <td>{{ $voyage->port_of_loading }}</td>
                    <td>{{ $voyage->port_of_discharge }}</td>
                    <td>{{ $voyage->departure }}</td>
                    <td>{{ $voyage->arrival }}</td>
                    <td>
                        <a href="{{ route('voyage.edit', $voyage->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('voyage.destroy', $voyage->id) }}" method="POST" style="display:inline-block;">
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
        $('#voyages-table').DataTable({
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
