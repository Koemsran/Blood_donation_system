@extends('layouts.app')

@section('title', 'Blood Requests')

@section('page')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-6">Blood Requests Management</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('blood-requests.create') }}" class="btn btn-warning btn-lg">
                <i class="fas fa-plus"></i> Create Request
            </a>
        </div>
    </div>

    @if ($requests->isEmpty())
        <div class="alert alert-info">
            <p class="mb-0">No blood requests yet. <a href="{{ route('blood-requests.create') }}">Create one now!</a></p>
        </div>
    @else
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-warning">
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Blood Type</th>
                            <th>Quantity (Units)</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td><strong>{{ $request->patient->name }}</strong></td>
                                <td>
                                    <span class="badge bg-danger">{{ $request->blood_type }}</span>
                                </td>
                                <td>{{ $request->quantity }}</td>
                                <td>{{ $request->request_date->format('M d, Y H:i') }}</td>
                                <td>
                                    @if ($request->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($request->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($request->status === 'completed')
                                        <span class="badge bg-info">Completed</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('blood-requests.show', $request) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('blood-requests.destroy', $request) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
