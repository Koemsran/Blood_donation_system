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
