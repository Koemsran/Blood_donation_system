@extends('layouts.app')

@section('title', 'Donor Details')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-6">Donor Details</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('donors.edit', $donor) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('donors.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">{{ $donor->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Age:</strong> {{ $donor->age }} years</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Blood Type:</strong> <span class="badge bg-danger">{{ $donor->blood_type }}</span></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Contact:</strong> {{ $donor->contact }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Last Donation:</strong>
                                @if ($donor->last_donation_date)
                                    {{ $donor->last_donation_date->format('M d, Y') }}
                                @else
                                    <span class="text-muted">Not yet donated</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p><strong>Registered:</strong> {{ $donor->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
