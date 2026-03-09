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
