@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Prescriptions</h1>
    <a href="{{ route('admin.prescriptions.create') }}" class="btn btn-primary mb-3">Create Prescription</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Image</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->id }}</td>
                    <td>{{ $prescription->user_id }}</td>
                    <td>{{ $prescription->image }}</td>
                    <td>{{ $prescription->status }}</td>
                    <td>{{ $prescription->notes }}</td>
                    <td>
                        <a href="{{ route('admin.prescriptions.show', $prescription) }}" class="btn btn-info">View</a>
                        <a href="{{ route('admin.prescriptions.edit', $prescription) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.prescriptions.destroy', $prescription) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
