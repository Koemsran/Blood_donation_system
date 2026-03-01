@extends('layouts.auth')

@section('title', 'Register - Blood Donation Management System')

@section('auth_content')
<div class="register-container" style="width: 100%; max-width: 500px;">
    <div class="card">
        <div class="card-header">
            <img src="{{ asset('images/logos/logo.svg') }}" alt="Logo" height="60">
            <h1>Create Account</h1>
            <p>Blood Donation Management System</p>
        </div>
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Registration Failed!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" required>
                    </div>
                    <small class="form-text text-muted">Minimum 8 characters</small>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control"
                            id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-register w-100">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>

            <div class="login-link" style="text-align: center; margin-top: 20px;">
                Already have an account? <a href="{{ route('login') }}" style="color: #dc3545; text-decoration: none; font-weight: 600;">Login here</a>
            </div>
        </div>
    </div>
</div>
@endsection
