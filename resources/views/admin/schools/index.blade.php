@extends('admin.layout.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Schools Management</h4>
                        <a href="{{ route('admin.schools.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New School
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Principal</th>
                                    <th>Students</th>
                                    <th>Teachers</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($schools as $school)
                                    <tr>
                                        <td>{{ $school->id }}</td>
                                        <td>{{ $school->name }}</td>
                                        <td>{{ Str::limit($school->address, 50) }}</td>
                                        <td>{{ $school->phone ?? 'N/A' }}</td>
                                        <td>{{ $school->email ?? 'N/A' }}</td>
                                        <td>{{ $school->principal_name ?? 'N/A' }}</td>
                                        <td>{{ number_format($school->total_students) }}</td>
                                        <td>{{ number_format($school->total_teachers) }}</td>
                                        <td>
                                            <span class="badge {{ $school->status ? 'bg-success' : 'bg-danger' }}">
                                                {{ $school->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.schools.show', $school->id) }}"
                                                   class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.schools.edit', $school->id) }}"
                                                   class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.schools.destroy', $school->id) }}"
                                                      method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this school?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No schools found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $schools->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
