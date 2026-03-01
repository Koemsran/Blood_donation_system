@extends('layouts.app')

@section('title', 'Donors')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-6">Donors Management</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('donors.create') }}" class="btn btn-danger btn-lg">
                <i class="fas fa-plus"></i> Register New Donor
            </a>
        </div>
    </div>

    @if ($donors->isEmpty())
        <div class="alert alert-info">
            <p class="mb-0">No donors registered yet. <a href="{{ route('donors.create') }}">Register one now!</a></p>
        </div>
    @else
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-danger">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Blood Type</th>
                            <th>Contact</th>
                            <th>Last Donation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donors as $donor)
                            <tr>
                                <td>{{ $donor->id }}</td>
                                <td><strong>{{ $donor->name }}</strong></td>
                                <td>{{ $donor->age }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ $donor->blood_type }}</span>
                                </td>
                                <td>{{ $donor->contact }}</td>
                                <td>
                                    @if ($donor->last_donation_date)
                                        {{ $donor->last_donation_date->format('M d, Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('donors.show', $donor) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('donors.edit', $donor) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('donors.destroy', $donor) }}" method="POST" style="display:inline;">
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
