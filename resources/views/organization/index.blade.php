@extends('adminlte::page')


@section('content')
<div class="container">
    <h1>Organizations</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addOrganizationModal">Add New Organization</button>
    <table class="table table-bordered" id="organizations-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($organizations as $organization)
                <tr>
                    <td>{{ $organization->id }}</td>
                    <td>{{ $organization->name }}</td>
                    <td>{{ $organization->description }}</td>
                    <td>{{ $organization->created_at }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <form action="#" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add Organization Modal -->
    <div class="modal fade" id="addOrganizationModal" tabindex="-1" aria-labelledby="addOrganizationModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addOrganizationModalLabel">Add Organization</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addOrganizationForm">
              @csrf
              <div class="mb-3">
                <label for="orgName" class="form-label">Name</label>
                <input type="text" class="form-control" id="orgName" name="name" required>
              </div>
              <div class="mb-3">
                <label for="orgDescription" class="form-label">Description</label>
                <textarea class="form-control" id="orgDescription" name="description"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables JS and CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#organizations-table').DataTable();
        $('#addOrganizationForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('organization-management.store') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error adding organization');
                }
            });
        });
    });
</script>
@endpush
