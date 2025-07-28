@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Organisations</h1>
    <a href="#" class="btn btn-primary mb-3">Add New Organisation</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($organisations as $organisation)
                <tr>
                    <td>{{ $organisation->id }}</td>
                    <td>{{ $organisation->name }}</td>
                    <td>{{ $organisation->description }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
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
</div>
@endsection
