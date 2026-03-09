@extends('layouts.app')

@section('title', 'Create Blood Request')

@section('page')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-6">Create Blood Request</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">Request Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('blood-requests.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="patient_id" class="form-label">Patient</label>
                            <select class="form-select @error('patient_id') is-invalid @enderror"
                                id="patient_id" name="patient_id" required>
                                <option value="">Select Patient</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->name }} ({{ $patient->blood_type }})
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="blood_type" class="form-label">Blood Type</label>
                                <select class="form-select @error('blood_type') is-invalid @enderror"
                                    id="blood_type" name="blood_type" required>
                                    <x-blood-type-options :selected="old('blood_type')" placeholder="Select Blood Type" />
                                </select>
                                @error('blood_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Quantity (Units)</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                    id="quantity" name="quantity" min="1" value="{{ old('quantity') }}" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('blood-requests.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-warning">Create Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
