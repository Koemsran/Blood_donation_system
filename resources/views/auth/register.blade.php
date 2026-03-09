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
                          fill="white" fill-opacity="0.9"/>
                    <circle cx="27" cy="10" r="6" fill="white" fill-opacity="0.85"/>
                    <path d="M24 10H30M27 7V13" stroke="#b91c1c" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <h1>Create Account</h1>
            <p>Blood Donation Management System</p>
            <div class="progress-bar-wrap">
                <div class="progress-fill" id="progressFill"></div>
            </div>
        </div>

        <div class="reg-body">

            @if ($errors->any())
                <div class="reg-alert">
                    <strong>Registration Failed!</strong>
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ═══════════ STEP 1 ═══════════ --}}
                <div class="step active" id="step1">
                    <div class="rg-group">
                        <label for="name">Full Name</label>
                        <div class="iw">
                            <span class="ico">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </span>
                            <input type="text" id="name" name="name" placeholder="Enter your full name"
                                   value="{{ old('name') }}" required autocomplete="name"
                                   class="@error('name') is-invalid @enderror">
                        </div>
                        @error('name')<span class="err-msg">{{ $message }}</span>@enderror
                    </div>

                    <div class="rg-group">
                        <label for="email">Email Address</label>
                        <div class="iw">
                            <span class="ico">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </span>
                            <input type="email" id="email" name="email" placeholder="you@example.com"
                                   value="{{ old('email') }}" required autocomplete="email"
                                   class="@error('email') is-invalid @enderror">
                        </div>
                        @error('email')<span class="err-msg">{{ $message }}</span>@enderror
                    </div>

                    <div class="rg-group">
                        <label for="phone">Phone Number</label>
                        <div class="iw">
                            <span class="ico">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.08 2.18 2 2 0 012.07 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                                </svg>
                            </span>
                            <input type="tel" id="phone" name="phone" placeholder="+1 (555) 000-0000"
                                   value="{{ old('phone') }}" required
                                   class="@error('phone') is-invalid @enderror">
                        </div>
                        @error('phone')<span class="err-msg">{{ $message }}</span>@enderror
                    </div>

                    <div class="rg-group">
                        <label for="password">Password</label>
                        <div class="iw">
                            <span class="ico">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                                    <path d="M7 11V7a5 5 0 0110 0v4"/>
                                </svg>
                            </span>
                            <input type="password" id="password" name="password"
                                   placeholder="Enter a secure password" required autocomplete="new-password"
                                   class="@error('password') is-invalid @enderror">
                            <button type="button" class="eye-btn" onclick="togglePw('password',this)" tabindex="-1">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                        <span class="hint">Minimum 8 characters</span>
                        @error('password')<span class="err-msg">{{ $message }}</span>@enderror
                    </div>

                    <div class="rg-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="iw">
                            <span class="ico">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                                    <path d="M7 11V7a5 5 0 0110 0v4"/>
                                </svg>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   placeholder="Confirm your password" required>
                            <button type="button" class="eye-btn" onclick="togglePw('password_confirmation',this)" tabindex="-1">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                             <div class="rg-group">
                        <label for="role">Select Your Role</label>
                        <div class="sw">
                            <select id="role" name="role" required
                                    class="rs @error('role') is-invalid @enderror">
                                <option value="" disabled selected>Choose your role</option>
                                <option value="donor" {{ old('role')=='donor' ? 'selected' : '' }}>Donor</option>
                                <option value="staff" {{ old('role')=='staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                        </div>
                        @error('role')<span class="err-msg">{{ $message }}</span>@enderror
                    </div>

                    <button type="button" class="btn-red" style="margin-top:6px;" onclick="goStep(2)">
                        → Continue to Next Step
                    </button>
                    <p class="login-lnk">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                </div>

                {{-- ═══════════ STEP 2 ═══════════ --}}
                <div class="step" id="step2">

                    {{-- Photo upload --}}
                    <!-- <div class="photo-wrap">
                        <input type="file" id="photo" name="photo" accept="image/*"
                               style="display:none" onchange="previewPhoto(this)">
                        <div class="photo-circle" onclick="document.getElementById('photo').click()">
                            <img id="photoPreview" src="" alt="">
                            <svg id="cameraIcon" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="1.8">
                                <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/>
                                <circle cx="12" cy="13" r="4"/>
                            </svg>
                        </div>
                        <span class="photo-lbl">Upload your photo (Optional)</span>
                    </div> -->

                    {{-- Gender + DOB row --}}
                    <div class="two-col">

                        <div class="rg-group">
                            <label for="gender">Gender</label>
                            <div class="sw">
                                <select id="gender" name="gender" required
                                        class="rs @error('gender') is-invalid @enderror">
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="male"       {{ old('gender')=='male'       ?'selected':'' }}>Male</option>
                                    <option value="female"     {{ old('gender')=='female'     ?'selected':'' }}>Female</option>
                                    <option value="other"      {{ old('gender')=='other'      ?'selected':'' }}>Other</option>
                                    <option value="prefer_not" {{ old('gender')=='prefer_not' ?'selected':'' }}>Prefer not to say</option>
                                </select>
                            </div>
                            @error('gender')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- ══ Modern DOB Picker ══ --}}
                        <div class="rg-group">
                            <label>Date of Birth</label>

                            {{-- Hidden input – submitted with the form --}}
                            <input type="hidden" id="date_of_birth" name="date_of_birth"
                                   value="{{ old('date_of_birth') }}">

                            <div class="dob-wrapper">

                                {{-- Visible trigger --}}
                                <div class="dob-trigger @error('date_of_birth') is-invalid @enderror"
                                     id="dobTrigger" onclick="dobToggle()">
                                    <svg class="dob-ico" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8"  y1="2" x2="8"  y2="6"/>
                                        <line x1="3"  y1="10" x2="21" y2="10"/>
                                    </svg>
                                    <span id="dobDisplay">Select date of birth</span>
                                    <svg class="dob-caret" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"/>
                                    </svg>
                                </div>

                                {{-- Picker panel --}}
                                <div class="dob-picker" id="dobPicker">

                                    {{-- Search --}}
                                    <div class="dob-search-wrap">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                             stroke="#9ca3af" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"/>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                        </svg>
                                        <input type="text" id="dobSearch"
                                               placeholder="Search month or year…"
                                               oninput="dobFilter(this.value)"
                                               autocomplete="off">
                                    </div>

                                    {{-- Month + Year --}}
                                    <div class="dob-selectors">
                                        <div class="dob-sel-wrap">
                                            <select id="dobMonth" onchange="dobRenderDays()">
                                                <option value="">Month</option>
                                            </select>
                                        </div>
                                        <div class="dob-sel-wrap">
                                            <select id="dobYear" onchange="dobRenderDays()">
                                                <option value="">Year</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Search results --}}
                                    <div class="dob-search-results" id="dobSearchResults"></div>

                                    {{-- Day grid --}}
                                    <div class="dob-days-label">Select Day</div>
                                    <div class="dob-days" id="dobDays"></div>

                                    {{-- Footer --}}
                                    <div class="dob-footer">
                                        <span class="dob-foot-label" id="dobFootLabel">No date selected</span>
                                        <span class="dob-clear-btn" onclick="dobClear()">✕ Clear</span>
                                    </div>

                                </div>{{-- /.dob-picker --}}
                            </div>{{-- /.dob-wrapper --}}
                            @error('date_of_birth')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>
                        {{-- ══ End DOB Picker ══ --}}

                    </div>{{-- /.two-col --}}

                    <div class="rg-group">
                        <label for="address">Location / Address</label>
                        <input type="text" id="address" name="address" placeholder="City, Region"
                               value="{{ old('address') }}" required
                               class="ri @error('address') is-invalid @enderror">
                        @error('address')<span class="err-msg">{{ $message }}</span>@enderror
                    </div>

                    <div class="rg-group">
                        <label for="blood_group">Blood Group</label>
                        <div class="sw">
                            <select id="blood_group" name="blood_group" required
                                    class="rs @error('blood_group') is-invalid @enderror">
                                <option value="" disabled selected>Select Your Blood Group</option>
                                @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                                    <option value="{{ $bg }}" {{ old('blood_group')==$bg?'selected':'' }}>{{ $bg }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('blood_group')<span class="err-msg">{{ $message }}</span>@enderror
                    </div>

                    <div class="sec-title">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="#b91c1c">
                            <path d="M12 2C12 2 5 9.5 5 15C5 18.866 8.134 22 12 22C15.866 22 19 18.866 19 15C19 9.5 12 2Z"/>
                        </svg>
                        Donation Information
                    </div>

                    <div class="two-col">
                        {{-- ══ Last Donation Date Picker ══ --}}
                        <div class="rg-group">
                            <label>Last Donation Date</label>
                            <input type="hidden" id="last_donation_date" name="last_donation_date"
                                   value="{{ old('last_donation_date') }}">
                            <div class="dob-wrapper">
                                <div class="dob-trigger @error('last_donation_date') is-invalid @enderror"
                                     id="lddTrigger" onclick="lddToggle()">
                                    <svg class="dob-ico" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8"  y1="2" x2="8"  y2="6"/>
                                        <line x1="3"  y1="10" x2="21" y2="10"/>
                                    </svg>
                                    <span id="lddDisplay">Select date</span>
                                    <svg class="dob-caret" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"/>
                                    </svg>
                                </div>
                                <div class="dob-picker" id="lddPicker">
                                    <div class="dob-search-wrap">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                             stroke="#9ca3af" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"/>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                        </svg>
                                        <input type="text" id="lddSearch"
                                               placeholder="Search month or year…"
                                               oninput="lddFilter(this.value)"
                                               autocomplete="off">
                                    </div>
                                    <div class="dob-selectors">
                                        <div class="dob-sel-wrap">
                                            <select id="lddMonth" onchange="lddRenderDays()">
                                                <option value="">Month</option>
                                            </select>
                                        </div>
                                        <div class="dob-sel-wrap">
                                            <select id="lddYear" onchange="lddRenderDays()">
                                                <option value="">Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="dob-search-results" id="lddSearchResults"></div>
                                    <div class="dob-days-label">Select Day</div>
                                    <div class="dob-days" id="lddDays"></div>
                                    <div class="dob-footer">
                                        <span class="dob-foot-label" id="lddFootLabel">No date selected</span>
                                        <span class="dob-clear-btn" onclick="lddClear()">✕ Clear</span>
                                    </div>
                                </div>
                            </div>
                            @error('last_donation_date')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>
                        {{-- ══ End Last Donation Date Picker ══ --}}
                        <div class="rg-group">
                            <label for="weight">Weight (kg)</label>
                            <input type="number" id="weight" name="weight" placeholder="e.g. 70"
                                   value="{{ old('weight') }}" min="30" max="300"
                                   class="ri @error('weight') is-invalid @enderror">
                            @error('weight')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="two-col">
                        <div class="rg-group">
                            <label for="available_time">Available Time</label>
                            <div class="sw">
                                <select id="available_time" name="available_time"
                                        class="rs @error('available_time') is-invalid @enderror">
                                    <option value="" disabled selected>Select availability</option>
                                    <option value="morning"   {{ old('available_time')=='morning'   ?'selected':'' }}>Morning (6am–12pm)</option>
                                    <option value="afternoon" {{ old('available_time')=='afternoon' ?'selected':'' }}>Afternoon (12pm–5pm)</option>
                                    <option value="evening"   {{ old('available_time')=='evening'   ?'selected':'' }}>Evening (5pm–9pm)</option>
                                    <option value="anytime"   {{ old('available_time')=='anytime'   ?'selected':'' }}>Anytime</option>
                                </select>
                            </div>
                            @error('available_time')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>
                        <div class="rg-group">
                            <label for="willing_to_donate">Willing to Donate Now?</label>
                            <div class="sw">
                                <select id="willing_to_donate" name="willing_to_donate" required
                                        class="rs @error('willing_to_donate') is-invalid @enderror">
                                    <option value="" disabled selected>Select option</option>
                                    <option value="yes"   {{ old('willing_to_donate')=='yes'   ?'selected':'' }}>Yes</option>
                                    <option value="no"    {{ old('willing_to_donate')=='no'    ?'selected':'' }}>No</option>
                                    <option value="maybe" {{ old('willing_to_donate')=='maybe' ?'selected':'' }}>Maybe</option>
                                </select>
                            </div>
                            @error('willing_to_donate')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <label class="consent-row">
                        <input type="checkbox" name="consent" id="consent" required>
                        I voluntarily consent to donate blood and agree to any necessary medical checks before donation.
                    </label>

                    <div class="btn-row">
                        <button type="button" class="btn-back" onclick="goStep(1)">← Back</button>
                        <button type="submit" class="btn-red">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="white">
                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                            </svg>
                            Complete Registration
                        </button>
                    </div>

                    <p class="login-lnk">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
/* ════════════════════════════════════
   Step navigation & general helpers
════════════════════════════════════ */
async function goStep(n) {
    // Validate step 1 before proceeding to step 2
    if (n === 2) {
        const isValid = await validateStep1();
        if (!isValid) {
            return;
        }
    }
    
    document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
    document.getElementById('step' + n).classList.add('active');
    document.getElementById('progressFill').style.width = n === 1 ? '50%' : '100%';
    document.querySelector('.reg-body').scrollTop = 0;
}

/**
 * Validate Step 1 fields (async)
 */
async function validateStep1() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('password_confirmation').value;
    const role = document.getElementById('role').value.trim();
    
    let isValid = true;
    let errors = [];
    
    // Clear previous error states
    document.querySelectorAll('#step1 .iw input').forEach(input => {
        input.classList.remove('is-invalid');
    });
    document.querySelectorAll('#step1 .sw select').forEach(select => {
        select.classList.remove('is-invalid');
    });
    
    // Validate name
    if (!name) {
        errors.push('Full name is required');
        document.getElementById('name').classList.add('is-invalid');
        isValid = false;
    }
    
    // Validate email
    if (!email) {
        errors.push('Email is required');
        document.getElementById('email').classList.add('is-invalid');
        isValid = false;
    } else if (!isValidEmail(email)) {
        errors.push('Please enter a valid email address');
        document.getElementById('email').classList.add('is-invalid');
        isValid = false;
    } else {
        // Check if email already exists in database
        try {
            const response = await fetch(`/api/check-email?email=${encodeURIComponent(email)}`);
            const data = await response.json();
            
            if (data.exists) {
                errors.push('This email is already registered. Please use a different email.');
                document.getElementById('email').classList.add('is-invalid');
                isValid = false;
            }
        } catch (error) {
            console.error('Error checking email:', error);
            // Don't block on API errors, let server-side validation handle it
        }
    }
    
    // Validate phone
    if (!phone) {
        errors.push('Phone number is required');
        document.getElementById('phone').classList.add('is-invalid');
        isValid = false;
    }
    
    // Validate password
    if (!password) {
        errors.push('Password is required');
        document.getElementById('password').classList.add('is-invalid');
        isValid = false;
    } else if (password.length < 8) {
        errors.push('Password must be at least 8 characters');
        document.getElementById('password').classList.add('is-invalid');
        isValid = false;
    }
    
    // Validate password confirmation
    if (!passwordConfirm) {
        errors.push('Please confirm your password');
        document.getElementById('password_confirmation').classList.add('is-invalid');
        isValid = false;
    } else if (password !== passwordConfirm) {
        errors.push('Passwords do not match');
        document.getElementById('password_confirmation').classList.add('is-invalid');
        isValid = false;
    }
    
    // Validate role
    if (!role) {
        errors.push('Please select a role');
        document.getElementById('role').classList.add('is-invalid');
        isValid = false;
    }
    
    // Remove existing alert
    const existingAlert = document.querySelector('.reg-alert');
    if (existingAlert) {
        existingAlert.remove();
    }
    
    // Show error alert if validation failed
    if (!isValid) {
        const alertHtml = `
            <div class="reg-alert">
                <strong>Please fix the following errors:</strong>
                <ul>${errors.map(e => `<li>${e}</li>`).join('')}</ul>
            </div>
        `;
        
        const regBody = document.querySelector('.reg-body');
        regBody.insertAdjacentHTML('afterbegin', alertHtml);
        regBody.scrollTop = 0;
    }
    
    return isValid;
}

/**
 * Basic email validation
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function togglePw(id, btn) {
    const inp = document.getElementById(id);
    inp.type  = inp.type === 'password' ? 'text' : 'password';
    btn.style.opacity = inp.type === 'text' ? '0.4' : '1';
}

function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('photoPreview');
            img.src = e.target.result;
            img.style.display = 'block';
            document.getElementById('cameraIcon').style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const s2 = ['gender','date_of_birth','address','blood_group',
                'last_donation_date','weight','available_time','willing_to_donate','consent'];
    if (s2.some(f => document.querySelector(`[name="${f}"].is-invalid`))) goStep(2);
    
    // Real-time email validation (with debounce)
    const emailInput = document.getElementById('email');
    let emailCheckTimeout;
    
    emailInput.addEventListener('blur', function() {
        const email = this.value.trim();
        if (email && isValidEmail(email)) {
            checkEmailRealTime(email);
        }
    });
    
    emailInput.addEventListener('input', function() {
        const email = this.value.trim();
        clearTimeout(emailCheckTimeout);
        
        // Clear previous real-time error
        const existingError = this.parentElement.querySelector('.email-exists-msg');
        if (existingError) {
            existingError.remove();
        }
        
        if (email && isValidEmail(email)) {
            // Debounce the check
            emailCheckTimeout = setTimeout(() => {
                checkEmailRealTime(email);
            }, 500);
        }
    });
});

/**
 * Check email in real-time and show immediate feedback
 */
async function checkEmailRealTime(email) {
    const emailInput = document.getElementById('email');
    const rgGroup = emailInput.closest('.rg-group');
    const existingError = rgGroup.querySelector('.email-exists-msg');
    
    // Remove any existing error message
    if (existingError) {
        existingError.remove();
    }
    
    try {
        const response = await fetch(`/api/check-email?email=${encodeURIComponent(email)}`);
        const data = await response.json();
        
        if (data.exists) {
            // Email already exists - show error
            const errorMsg = document.createElement('span');
            errorMsg.className = 'email-exists-msg err-msg';
            errorMsg.textContent = '✕ This email is already registered';
            
            rgGroup.appendChild(errorMsg);
            emailInput.classList.add('is-invalid');
        } else {
            // Email is available
            emailInput.classList.remove('is-invalid');
        }
    } catch (error) {
        console.error('Error checking email:', error);
    }
}

/* ════════════════════════════════════
   Reusable Date Picker Factory
   Powers: DOB picker + Last Donation Date picker
════════════════════════════════════ */
(function () {
    var MONTHS = ['January','February','March','April','May','June',
                  'July','August','September','October','November','December'];
    var SHORT  = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var DOWS   = ['Su','Mo','Tu','We','Th','Fr','Sa'];

    /**
     * makePicker(cfg)
     *  cfg.hiddenId   – id of <input type="hidden"> holding the value
     *  cfg.triggerId  – id of the visible trigger div
     *  cfg.pickerId   – id of the picker panel div
     *  cfg.displayId  – id of the <span> showing selected date text
     *  cfg.footId     – id of the footer label span
     *  cfg.searchId   – id of the search <input>
     *  cfg.resultsId  – id of the search-results div
     *  cfg.monthSelId – id of month <select>
     *  cfg.yearSelId  – id of year <select>
     *  cfg.daysId     – id of the day-grid div
     *  cfg.placeholder – placeholder text when nothing selected
     *  cfg.maxYear    – highest selectable year (default: current year)
     *  cfg.toggleFn   – window-level toggle function name
     *  cfg.renderFn   – window-level render function name (called by onchange)
     *  cfg.filterFn   – window-level filter function name (called by oninput)
     *  cfg.clearFn    – window-level clear function name
     */
    function makePicker(cfg) {
        var selY = null, selM = null, selD = null;
        var nowY = new Date().getFullYear();
        var maxY = cfg.maxYear !== undefined ? cfg.maxYear : nowY;

        function $(id) { return document.getElementById(id); }

        /* ── Populate selects ── */
        function init() {
            var mSel = $(cfg.monthSelId);
            var ySel = $(cfg.yearSelId);
            if (!mSel || !ySel) return;

            MONTHS.forEach(function (name, i) {
                var o = document.createElement('option');
                o.value = i + 1; o.textContent = name;
                mSel.appendChild(o);
            });

            for (var y = maxY; y >= maxY - 110; y--) {
                var o = document.createElement('option');
                o.value = y; o.textContent = y;
                ySel.appendChild(o);
            }

            // Restore old() value
            var oldVal = $(cfg.hiddenId) ? $(cfg.hiddenId).value : '';
            if (oldVal) {
                var d = new Date(oldVal + 'T00:00:00');
                if (!isNaN(d)) {
                    selY = d.getFullYear(); selM = d.getMonth() + 1; selD = d.getDate();
                    mSel.value = selM; ySel.value = selY;
                    updateDisplay();
                }
            }
            renderGrid();

            // Close on outside click
            document.addEventListener('click', function (e) {
                var p = $(cfg.pickerId), t = $(cfg.triggerId);
                if (p && t && !p.contains(e.target) && !t.contains(e.target)) {
                    closePicker();
                }
            });
        }

        /* ── Open / close ── */
        function togglePicker() {
            var p = $(cfg.pickerId), t = $(cfg.triggerId);
            if (!p || !t) return;
            if (p.classList.contains('open')) {
                closePicker();
            } else {
                // Close all other open pickers first
                document.querySelectorAll('.dob-picker.open').forEach(function (el) {
                    el.classList.remove('open');
                });
                document.querySelectorAll('.dob-trigger.open').forEach(function (el) {
                    el.classList.remove('open');
                });

                // Position picker using viewport-relative fixed coords
                var rect    = t.getBoundingClientRect();
                var pickerW = 280;

                // Temporarily show off-screen to measure real height
                p.style.visibility = 'hidden';
                p.style.top        = '-9999px';
                p.style.left       = '-9999px';
                p.classList.add('open');
                var pickerH = p.offsetHeight;
                p.classList.remove('open');
                p.style.visibility = '';

                var spaceBelow = window.innerHeight - rect.bottom;
                var spaceAbove = rect.top;
                var top;

                // Prefer opening below; only flip above if below has less room AND above has enough
                if (spaceBelow >= pickerH + 8) {
                    top = rect.bottom + 4;
                } else if (spaceAbove >= pickerH + 8) {
                    top = rect.top - pickerH - 4;
                } else {
                    // Not enough room either way — open below and let it scroll
                    top = rect.bottom + 4;
                    // Clamp so it doesn't go past viewport bottom
                    if (top + pickerH > window.innerHeight - 8) {
                        top = window.innerHeight - pickerH - 8;
                    }
                }
                if (top < 8) top = 8;

                // left: align with trigger, clamp to viewport
                var left = rect.left;
                if (left + pickerW > window.innerWidth - 8) {
                    left = window.innerWidth - pickerW - 8;
                }
                if (left < 8) left = 8;

                p.style.top  = top  + 'px';
                p.style.left = left + 'px';

                p.classList.add('open');
                t.classList.add('open');
                $(cfg.searchId).focus();
            }
        }

        function closePicker() {
            var p = $(cfg.pickerId), t = $(cfg.triggerId);
            if (p) p.classList.remove('open');
            if (t) t.classList.remove('open');
            hideResults();
        }

        /* ── Day grid ── */
        function renderGrid() {
            var grid = $(cfg.daysId);
            if (!grid) return;
            var m = parseInt($(cfg.monthSelId).value) || null;
            var y = parseInt($(cfg.yearSelId).value)  || null;

            grid.innerHTML = DOWS.map(function (d) {
                return '<div class="dob-dow">' + d + '</div>';
            }).join('');

            if (!m || !y) {
                grid.insertAdjacentHTML('beforeend',
                    '<div class="dob-empty-hint">Select a month &amp; year above</div>');
                return;
            }

            selM = m; selY = y;
            var firstDow    = new Date(y, m - 1, 1).getDay();
            var daysInMonth = new Date(y, m, 0).getDate();

            for (var i = 0; i < firstDow; i++) {
                grid.insertAdjacentHTML('beforeend', '<div></div>');
            }
            for (var d = 1; d <= daysInMonth; d++) {
                var btn = document.createElement('div');
                btn.className = 'dob-day-btn' +
                    (d === selD && m === selM && y === selY ? ' sel' : '');
                btn.textContent = d;
                (function (day) {
                    btn.addEventListener('click', function () { pickDay(day); });
                })(d);
                grid.appendChild(btn);
            }
        }

        /* ── Pick a day ── */
        function pickDay(day) {
            selD = day;
            var m = parseInt($(cfg.monthSelId).value);
            var y = parseInt($(cfg.yearSelId).value);
            if (!m || !y) return;
            var mm = String(m).padStart(2, '0');
            var dd = String(day).padStart(2, '0');
            $(cfg.hiddenId).value = y + '-' + mm + '-' + dd;
            updateDisplay();
            renderGrid();
            closePicker();
        }

        /* ── Update labels ── */
        function updateDisplay() {
            if (!selY || !selM || !selD) return;
            var label = SHORT[selM - 1] + ' ' + selD + ', ' + selY;
            var disp  = $(cfg.displayId);
            var foot  = $(cfg.footId);
            var trig  = $(cfg.triggerId);
            if (disp) disp.textContent = label;
            if (foot) { foot.textContent = label; foot.classList.add('set'); }
            if (trig) trig.classList.add('has-value');
        }

        /* ── Search ── */
        function filterOptions(q) {
            var query  = q.trim().toLowerCase();
            var resBox = $(cfg.resultsId);
            if (!query) { hideResults(); return; }

            var items = [];

            MONTHS.forEach(function (name, i) {
                if (name.toLowerCase().startsWith(query)) {
                    items.push({
                        label: name, badge: 'Month',
                        act: (function (idx) {
                            return function () {
                                $(cfg.monthSelId).value = idx + 1;
                                renderGrid();
                                $(cfg.searchId).value = '';
                                hideResults();
                            };
                        })(i)
                    });
                }
            });

            for (var y = maxY; y >= maxY - 110 && items.length < 10; y--) {
                if (String(y).startsWith(query)) {
                    items.push({
                        label: String(y), badge: 'Year',
                        act: (function (yr) {
                            return function () {
                                $(cfg.yearSelId).value = yr;
                                renderGrid();
                                $(cfg.searchId).value = '';
                                hideResults();
                            };
                        })(y)
                    });
                }
            }

            if (!items.length) {
                resBox.innerHTML =
                    '<div class="dob-result-item" style="color:#9ca3af;cursor:default">No results found</div>';
            } else {
                resBox.innerHTML = items.slice(0, 8).map(function (r, i) {
                    return '<div class="dob-result-item" data-ri="' + i + '">' +
                               r.label + '<span class="res-badge">' + r.badge + '</span>' +
                           '</div>';
                }).join('');
                items.slice(0, 8).forEach(function (r, i) {
                    resBox.querySelector('[data-ri="' + i + '"]').addEventListener('click', r.act);
                });
            }
            resBox.classList.add('visible');
        }

        function hideResults() {
            var r = $(cfg.resultsId);
            if (r) r.classList.remove('visible');
        }

        /* ── Clear ── */
        function clearPicker() {
            selY = null; selM = null; selD = null;
            $(cfg.hiddenId).value = '';
            var disp = $(cfg.displayId), foot = $(cfg.footId), trig = $(cfg.triggerId);
            if (disp) disp.textContent = cfg.placeholder;
            if (foot) { foot.textContent = 'No date selected'; foot.classList.remove('set'); }
            if (trig) trig.classList.remove('has-value');
            $(cfg.monthSelId).value = '';
            $(cfg.yearSelId).value  = '';
            $(cfg.searchId).value   = '';
            renderGrid();
            hideResults();
        }

        /* ── Expose to window ── */
        window[cfg.toggleFn] = togglePicker;
        window[cfg.renderFn] = renderGrid;
        window[cfg.filterFn] = filterOptions;
        window[cfg.clearFn]  = clearPicker;

        document.addEventListener('DOMContentLoaded', init);
    }

    /* ══ Instantiate DOB picker ══ */
    makePicker({
        hiddenId:   'date_of_birth',
        triggerId:  'dobTrigger',
        pickerId:   'dobPicker',
        displayId:  'dobDisplay',
        footId:     'dobFootLabel',
        searchId:   'dobSearch',
        resultsId:  'dobSearchResults',
        monthSelId: 'dobMonth',
        yearSelId:  'dobYear',
        daysId:     'dobDays',
        placeholder:'Select date of birth',
        maxYear:    new Date().getFullYear() - 1,
        toggleFn:   'dobToggle',
        renderFn:   'dobRenderDays',
        filterFn:   'dobFilter',
        clearFn:    'dobClear'
    });

    /* ══ Instantiate Last Donation Date picker ══ */
    makePicker({
        hiddenId:   'last_donation_date',
        triggerId:  'lddTrigger',
        pickerId:   'lddPicker',
        displayId:  'lddDisplay',
        footId:     'lddFootLabel',
        searchId:   'lddSearch',
        resultsId:  'lddSearchResults',
        monthSelId: 'lddMonth',
        yearSelId:  'lddYear',
        daysId:     'lddDays',
        placeholder:'Select date',
        maxYear:    new Date().getFullYear(),   // can be today or earlier
        toggleFn:   'lddToggle',
        renderFn:   'lddRenderDays',
        filterFn:   'lddFilter',
        clearFn:    'lddClear'
    });

})();
</script>

@endsection