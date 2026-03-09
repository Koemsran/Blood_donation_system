@extends('layouts.app')

@section('title', 'Edit Donor')

@section('page')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-6">Edit Donor</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">Donor Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('donors.update', $donor) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $donor->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $donor->date_of_birth) }}" required>
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="blood_type" class="form-label">Blood Type</label>
                                <select class="form-select @error('blood_type') is-invalid @enderror"
                                    id="blood_type" name="blood_type" required>
                                    <x-blood-type-options :selected="old('blood_type', $donor->blood_type)" placeholder="Select Blood Type" />
                                </select>
                                @error('blood_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                id="contact" name="contact" value="{{ old('contact', $donor->contact) }}" required>
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('donors.show', $donor) }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-danger">Update Donor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
