@extends('layouts.app')

@section('title', 'Blood Request Details')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-6">Blood Request Details</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('blood-requests.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">Request #{{ $request->id }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Patient:</strong> {{ $request->patient->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Blood Type:</strong> <span class="badge bg-danger">{{ $request->blood_type }}</span></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Quantity:</strong> {{ $request->quantity }} units</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong>
                                @if ($request->status === 'pending')
                                    <span class="badge bg-warning">{{ ucfirst($request->status) }}</span>
                                @elseif ($request->status === 'approved')
                                    <span class="badge bg-success">{{ ucfirst($request->status) }}</span>
                                @elseif ($request->status === 'completed')
                                    <span class="badge bg-info">{{ ucfirst($request->status) }}</span>
                                @else
                                    <span class="badge bg-danger">{{ ucfirst($request->status) }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p><strong>Requested Date:</strong> {{ $request->request_date->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    @if ($request->status === 'pending')
                        <hr>
                        <form action="{{ route('blood-requests.update-status', $request) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="status" class="form-label">Update Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="approved">Approve</option>
                                    <option value="completed">Mark as Completed</option>
                                    <option value="cancelled">Cancel</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning">Update Status</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
