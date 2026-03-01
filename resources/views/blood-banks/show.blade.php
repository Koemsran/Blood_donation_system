@extends('layouts.app')

@section('title', 'Blood Bank Details')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-6">Blood Bank Details</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('blood-banks.edit', $bank) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('blood-banks.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">{{ $bank->name }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>Location:</strong> {{ $bank->location }}</p>
                    <p><strong>Contact:</strong> {{ $bank->contact }}</p>
                    <p><strong>Registered:</strong> {{ $bank->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>

            <!-- Blood Stock Section -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Blood Stock</h5>
                </div>
                @if ($bank->bloodStocks->isEmpty())
                    <div class="card-body">
                        <p class="text-muted">No blood stock available</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Blood Type</th>
                                    <th>Quantity (Units)</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bank->bloodStocks as $stock)
                                    <tr>
                                        <td><span class="badge bg-danger">{{ $stock->blood_type }}</span></td>
                                        <td>{{ $stock->quantity }}</td>
                                        <td>
                                            @if ($stock->expiry_date)
                                                {{ $stock->expiry_date->format('M d, Y') }}
                                                @if ($stock->expiry_date < now())
                                                    <span class="badge bg-danger">Expired</span>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Staff Section -->
            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Staff</h5>
                </div>
                @if ($bank->staff->isEmpty())
                    <div class="card-body">
                        <p class="text-muted">No staff assigned</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bank->staff as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->role }}</td>
                                        <td>{{ $member->contact }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
