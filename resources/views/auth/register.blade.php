@extends('layouts.base')

@section('title', 'Register - Blood Donation Management System')

@section('content')

    <div class="reg-page">
        <div class="reg-card">

            {{-- ── Header ── --}}
            <div class="reg-header">
                <div class="logo-wrap">
                    <svg width="30" height="30" viewBox="0 0 38 38" fill="none">
                        <path d="M19 4C19 4 8 14 8 22C8 28.627 12.925 34 19 34C25.075 34 30 28.627 30 22C30 14 19 4Z"
                            fill="white" fill-opacity="0.9" />
                        <circle cx="27" cy="10" r="6" fill="white" fill-opacity="0.85" />
                        <path d="M24 10H30M27 7V13" stroke="#b91c1c" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </div>
                <h1>Create Account</h1>
                <p>Blood Donation Management System</p>
                <div class="progress-bar-wrap">
                    <div class="progress-fill" id="progressFill" style="width: {{ $currentStep == 1 ? '50%' : '100%' }};"></div>
                </div>
            </div>

            <div class="reg-body">

                @if ($errors->any())
                    <div class="reg-alert">
                        <strong>Registration Failed!</strong>
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                {{-- ═══════════ STEP 1 ═══════════ --}}
                <div class="step {{ $currentStep == 1 ? 'active' : '' }}" id="step1">
                    <form id="step1Form" onsubmit="submitStep1(event)">
                        @csrf

                        <div class="rg-group">
                            <label for="name">Full Name</label>
                            <div class="iw">
                                <span class="ico">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </span>
                                <input type="text" id="name" name="name" placeholder="Enter your full name"
                                    value="{{ old('name', $step1Data['name'] ?? '') }}" required autocomplete="name">
                            </div>
                            <span class="err-msg" id="name-error"></span>
                        </div>

                        <div class="rg-group">
                            <label for="email">Email Address</label>
                            <div class="iw">
                                <span class="ico">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                        <polyline points="22,6 12,13 2,6" />
                                    </svg>
                                </span>
                                <input type="email" id="email" name="email" placeholder="you@example.com"
                                    value="{{ old('email', $step1Data['email'] ?? '') }}" required autocomplete="email">
                            </div>
                            <span class="err-msg" id="email-error"></span>
                        </div>

                        <div class="rg-group">
                            <label for="phone">Phone Number</label>
                            <div class="iw">
                                <span class="ico">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path
                                            d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.08 2.18 2 2 0 012.07 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" />
                                    </svg>
                                </span>
                                <input type="tel" id="phone" name="phone" placeholder="+1 (555) 000-0000"
                                    value="{{ old('phone', $step1Data['phone'] ?? '') }}" required>
                            </div>
                            <span class="err-msg" id="phone-error"></span>
                        </div>

                        <div class="rg-group">
                            <label for="password">Password</label>
                            <div class="iw">
                                <span class="ico">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <rect x="3" y="11" width="18" height="11" rx="2" />
                                        <path d="M7 11V7a5 5 0 0110 0v4" />
                                    </svg>
                                </span>
                                <input type="password" id="password" name="password" placeholder="Enter a secure password"
                                    required autocomplete="new-password">
                                <button type="button" class="eye-btn" onclick="togglePw('password',this)" tabindex="-1">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                            <span class="hint">Minimum 8 characters</span>
                            <span class="err-msg" id="password-error"></span>
                        </div>

                        <div class="rg-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="iw">
                                <span class="ico">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <rect x="3" y="11" width="18" height="11" rx="2" />
                                        <path d="M7 11V7a5 5 0 0110 0v4" />
                                    </svg>
                                </span>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Confirm your password" required>
                                <button type="button" class="eye-btn" onclick="togglePw('password_confirmation',this)"
                                    tabindex="-1">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                            <span class="err-msg" id="password_confirmation-error"></span>
                        </div>

                        <div class="rg-group">
                            <label for="role">Select Your Role</label>
                            <div class="iw">
                                <span class="ico">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </span>
                                <select id="role" name="role" required>
                                    <option value="" disabled {{ empty(old('role', $step1Data['role'] ?? '')) ? 'selected' : '' }}>Choose your role</option>
                                    <option value="donor" {{ (old('role', $step1Data['role'] ?? '') == 'donor') ? 'selected' : '' }}>Donor</option>
                                    <option value="staff" {{ (old('role', $step1Data['role'] ?? '') == 'staff') ? 'selected' : '' }}>Staff</option>
                                </select>
                            </div>
                            <span class="err-msg" id="role-error"></span>
                        </div>

                        <button type="submit" class="btn-red" style="margin-top:6px;">
                            → Continue to Next Step
                        </button>
                        <p class="login-lnk">Already have an account? <a href="{{ route('register.clear') }}">Login here</a></p>
                    </form>
                </div>

                {{-- ═══════════ STEP 2 ═══════════ --}}
                <div class="step {{ $currentStep == 2 ? 'active' : '' }}" id="step2">
                    <form id="step2Form" action="{{ route('register.submit') }}" method="POST">
                        @csrf

                        {{-- Show DONOR form if donor role --}}
                        <div id="donorFormContent" style="display: {{ ($step1Data['role'] ?? '') == 'donor' ? 'block' : 'none' }};">
                            
                            <div class="sec-title" style="margin-bottom: 24px;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="#b91c1c">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                                Donor Profile Information
                            </div>

                            <div class="two-col">
                                <div class="rg-group">
                                    <label for="gender">Gender</label>
                                    <div class="iw">
                                        <span class="ico">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 2a4 4 0 1 0 0 8 4 4 0 0 0 0-8z" />
                                                <path d="M12 14c-4 0-6 2-6 4v3h12v-3c0-2-2-4-6-4z" />
                                            </svg>
                                        </span>
                                        <select id="gender" name="gender" {{ ($step1Data['role'] ?? '') == 'donor' ? 'required' : '' }}
                                            class="{{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    @error('gender')<span class="err-msg">{{ $message }}</span>@enderror
                                </div>

                                <div class="rg-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <div class="iw">
                                        <span class="ico">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                                <polyline points="16 2 16 6 8 6 8 2" />
                                                <polyline points="3 10 21 10" />
                                            </svg>
                                        </span>
                                        <input type="date" id="date_of_birth" name="date_of_birth"
                                            value="{{ old('date_of_birth') }}" {{ ($step1Data['role'] ?? '') == 'donor' ? 'required' : '' }}
                                            class="{{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}">
                                    </div>
                                    @error('date_of_birth')<span class="err-msg">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="rg-group">
                                <label for="address">Location / Address</label>
                                <div class="iw">
                                    <span class="ico">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                    </span>
                                    <input type="text" id="address" name="address" placeholder="e.g., Cairo, Egypt"
                                        value="{{ old('address') }}" {{ ($step1Data['role'] ?? '') == 'donor' ? 'required' : '' }}
                                        class="{{ $errors->has('address') ? 'is-invalid' : '' }}">
                                </div>
                                @error('address')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="rg-group">
                                <label for="blood_group">Blood Group</label>
                                <div class="iw">
                                    <span class="ico">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#b91c1c">
                                            <path d="M12 2C12 2 5 9.5 5 15C5 18.866 8.134 22 12 22C15.866 22 19 18.866 19 15C19 9.5 12 2Z" />
                                        </svg>
                                    </span>
                                    <select id="blood_group" name="blood_group" {{ ($step1Data['role'] ?? '') == 'donor' ? 'required' : '' }}
                                        class="{{ $errors->has('blood_group') ? 'is-invalid' : '' }}">
                                        <option value="" disabled selected>Select Your Blood Group</option>
                                        @foreach(\App\Enums\BloodType::values() as $bg)
                                            <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('blood_group')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="two-col">
                                <div class="rg-group">
                                    <label for="last_donation_date">Last Donation Date</label>
                                    <div class="iw">
                                        <span class="ico">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                                <polyline points="16 2 16 6 8 6 8 2" />
                                                <polyline points="3 10 21 10" />
                                            </svg>
                                        </span>
                                        <input type="date" id="last_donation_date" name="last_donation_date"
                                            value="{{ old('last_donation_date') }}"
                                            class="{{ $errors->has('last_donation_date') ? 'is-invalid' : '' }}"
                                            placeholder="When did you last donate?">
                                    </div>
                                    @error('last_donation_date')<span class="err-msg">{{ $message }}</span>@enderror
                                </div>

                                <div class="rg-group">
                                    <label for="weight">Weight (kg)</label>
                                    <div class="iw">
                                        <span class="ico">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="5" r="3" />
                                                <path d="M12 8v12M6 21h12" />
                                            </svg>
                                        </span>
                                        <input type="number" id="weight" name="weight" placeholder="e.g., 70"
                                            value="{{ old('weight') }}" min="30" max="300"
                                            class="{{ $errors->has('weight') ? 'is-invalid' : '' }}">
                                    </div>
                                    @error('weight')<span class="err-msg">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- Show STAFF form if staff role --}}
                        <div id="staffFormContent" style="display: {{ ($step1Data['role'] ?? '') == 'staff' ? 'block' : 'none' }};">
                            
                            <div class="sec-title" style="margin-bottom: 24px;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="#b91c1c">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                                Staff Profile Information
                            </div>

                            <div class="rg-group">
                                <label for="staff_username">Display Name</label>
                                <div class="iw">
                                    <span class="ico">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </span>
                                    <input type="text" id="staff_username" name="staff_username" placeholder="Your display name"
                                        value="{{ old('staff_username') }}" {{ ($step1Data['role'] ?? '') == 'staff' ? 'required' : '' }}
                                        class="{{ $errors->has('staff_username') ? 'is-invalid' : '' }}">
                                </div>
                                @error('staff_username')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="rg-group">
                                <label for="staff_role">Staff Role/Position</label>
                                <div class="iw">
                                    <span class="ico">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 2a10 10 0 1020 0 10 10 0 00-20 0" />
                                            <path d="M12 6v6l4 2" />
                                        </svg>
                                    </span>
                                    <input type="text" id="staff_role" name="staff_role" placeholder="e.g., Lab Manager, Nurse, Technician"
                                        value="{{ old('staff_role') }}" {{ ($step1Data['role'] ?? '') == 'staff' ? 'required' : '' }}
                                        class="{{ $errors->has('staff_role') ? 'is-invalid' : '' }}">
                                </div>
                                @error('staff_role')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="rg-group">
                                <label for="staff_contact">Contact Information</label>
                                <div class="iw">
                                    <span class="ico">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path
                                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.08 2.18 2 2 0 012.07 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" />
                                        </svg>
                                    </span>
                                    <input type="tel" id="staff_contact" name="staff_contact" placeholder="+1 (555) 000-0000"
                                        value="{{ old('staff_contact') }}" {{ ($step1Data['role'] ?? '') == 'staff' ? 'required' : '' }}
                                        class="{{ $errors->has('staff_contact') ? 'is-invalid' : '' }}">
                                </div>
                                @error('staff_contact')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="rg-group">
                                <label for="blood_bank_id">Assigned Blood Bank</label>
                                <div class="sw">
                                    <select id="blood_bank_id" name="blood_bank_id"
                                        class="rs {{ $errors->has('blood_bank_id') ? 'is-invalid' : '' }}">
                                        <option value="" disabled selected>Select Blood Bank</option>
                                        <option value="">Not Assigned</option>
                                        @foreach($bloodBanks as $bank)
                                            <option value="{{ $bank->id }}" {{ old('blood_bank_id') == $bank->id ? 'selected' : '' }}>
                                                {{ $bank->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('blood_bank_id')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="btn-row" style="margin-top: 32px;">
                            <button type="submit" class="btn-red" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 16px; font-weight: 600;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="white">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                                </svg>
                                Complete Registration
                            </button>
                        </div>

                        <p class="login-lnk" style="margin-top: 16px; text-align: center;">Already have an account? <a href="{{ route('register.clear') }}">Login here</a></p>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePw(id, btn) {
            const inp = document.getElementById(id);
            inp.type = inp.type === 'password' ? 'text' : 'password';
            btn.style.opacity = inp.type === 'text' ? '0.4' : '1';
        }

        /**
         * Submit Step 1 form
         */
        async function submitStep1(event) {
            event.preventDefault();
            clearErrors();

            const formData = new FormData(document.getElementById('step1Form'));

            try {
                const response = await fetch('{{ route('register.step1') }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    // Handle validation errors
                    if (data.errors) {
                        displayErrors(data.errors);
                    }
                    return;
                }

                // Success - move to step 2
                document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
                document.getElementById('step2').classList.add('active');
                document.getElementById('progressFill').style.width = '100%';

                // Show appropriate form based on role
                const role = data.role;
                if (role === 'donor') {
                    document.getElementById('donorFormContent').style.display = 'block';
                    document.getElementById('staffFormContent').style.display = 'none';
                } else if (role === 'staff') {
                    document.getElementById('donorFormContent').style.display = 'none';
                    document.getElementById('staffFormContent').style.display = 'block';
                }

                // Scroll to top
                document.querySelector('.reg-body').scrollTop = 0;

            } catch (error) {
                console.error('Error:', error);
                showAlert('An error occurred. Please try again.', 'error');
            }
        }

        /**
         * Display validation errors on form
         */
        function displayErrors(errors) {
            for (let field in errors) {
                const errorElement = document.getElementById(`${field}-error`);
                if (errorElement) {
                    errorElement.textContent = errors[field][0];
                    errorElement.style.display = 'block';
                }
            }
        }

        /**
         * Clear all error messages
         */
        function clearErrors() {
            document.querySelectorAll('.err-msg').forEach(el => {
                if (el.id) { // Only clear inline error messages
                    el.textContent = '';
                    el.style.display = 'none';
                }
            });
        }

        /**
         * Show alert message
         */
        function showAlert(message, type = 'error') {
            const alert = document.createElement('div');
            alert.className = `reg-alert ${type}`;
            alert.innerHTML = `<strong>${type === 'error' ? 'Error!' : 'Success!'}</strong><p>${message}</p>`;

            const regBody = document.querySelector('.reg-body');
            regBody.insertAdjacentElement('afterbegin', alert);
            regBody.scrollTop = 0;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function () {
            // If any step 2 fields have errors, show step 2
            const step2Fields = ['gender', 'date_of_birth', 'address', 'blood_group', 'last_donation_date', 'weight', 'staff_username', 'staff_role', 'staff_contact', 'blood_bank_id'];
            const hasStep2Errors = step2Fields.some(field => document.querySelector(`[name="${field}"].is-invalid`));

            // This is handled by Laravel backend, but we can keep this for extra safety
            if (hasStep2Errors) {
                document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
                document.getElementById('step2').classList.add('active');
            }
        });
    </script>

@endsection
