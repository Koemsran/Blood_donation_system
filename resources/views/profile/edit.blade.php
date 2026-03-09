@extends('layouts.app')

@section('title', 'Profile Settings')

@section('page')
    <div class="profile-container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1><i class="fas fa-user-circle"></i> Profile Settings</h1>
                <p class="text-muted">Manage your account information</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0 text-white">Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', auth()->user()->name) }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <small class="text-muted">(Cannot be changed)</small></label>
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    id="email" 
                                    value="{{ auth()->user()->email }}"
                                    disabled>
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-lock"></i> Your email cannot be changed for security reasons
                                </small>
                            </div>

                            <!-- Phone Field -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input 
                                    type="tel" 
                                    class="form-control @error('phone') is-invalid @enderror" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone', auth()->user()->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address Field -->
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea 
                                    class="form-control @error('address') is-invalid @enderror" 
                                    id="address" 
                                    name="address" 
                                    rows="3">{{ old('address', auth()->user()->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0 text-white">Account Info</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block">Role</small>
                            <strong>{{ ucfirst(auth()->user()->role) }}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Member Since</small>
                            <strong>{{ auth()->user()->created_at->format('M d, Y') }}</strong>
                        </div>
                        <hr>
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i> Keep your profile information up to date
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
