<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donor;
use App\Models\Staff;
use App\Models\BloodBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $bloodBanks = BloodBank::all();
        
        // Check if user has completed step 1
        $step1Complete = session()->has('register_step1');
        $currentStep = $step1Complete ? 2 : 1;
        $step1Data = session()->get('register_step1', []);
        
        return view('auth.register', compact('bloodBanks', 'currentStep', 'step1Data'));
    }

    /**
     * Validate and store Step 1 data in session
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateStep1(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:donor,staff',
        ]);

        // Store step 1 data in session
        session(['register_step1' => $validated]);

        return response()->json([
            'success' => true,
            'message' => 'Step 1 validated successfully',
            'role' => $validated['role']
        ]);
    }

    /**
     * Check if email exists in the database (AJAX)
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkEmailExists(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return response()->json(['exists' => false, 'valid' => false]);
        }

        // Basic email format validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['exists' => false, 'valid' => false]);
        }

        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists, 'valid' => true]);
    }

    /**
     * Complete registration with Step 2 data
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Check if step 1 data exists in session
        if (!session()->has('register_step1')) {
            return redirect()->route('register')->with('error', 'Please complete Step 1 first');
        }

        $step1Data = session('register_step1');
        $role = $step1Data['role'];

        // Validate step 2 based on role
        if ($role === 'donor') {
            $step2Validated = $request->validate([
                'gender' => 'required|in:male,female',
                'date_of_birth' => 'required|date',
                'address' => 'required|string|max:255',
                'blood_group' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                'last_donation_date' => 'nullable|date',
                'weight' => 'nullable|numeric|min:30|max:300',
            ]);
        } else if ($role === 'staff') {
            $step2Validated = $request->validate([
                'staff_username' => 'required|string|max:255',
                'staff_role' => 'required|string|max:255',
                'staff_contact' => 'required|string|max:255',
                'blood_bank_id' => 'nullable|exists:blood_banks,id',
            ]);
        } else {
            return redirect()->route('register')->with('error', 'Invalid role');
        }

        // Create User record
        $user = User::create([
            'name' => $step1Data['name'],
            'email' => $step1Data['email'],
            'phone' => $step1Data['phone'],
            'password' => Hash::make($step1Data['password']),
            'role' => $role,
            'address' => $step2Validated['address'] ?? null,
            'gender' => $step2Validated['gender'] ?? null,
        ]);

        // If donor, create Donor record
        if ($role === 'donor') {
            Donor::create([
                'name' => $step1Data['name'],
                'date_of_birth' => $step2Validated['date_of_birth'],
                'blood_type' => $step2Validated['blood_group'],
                'contact' => $step1Data['phone'],
                'last_donation_date' => $step2Validated['last_donation_date'] ?? null,
            ]);
        }
        // If staff, create Staff record
        else if ($role === 'staff') {
            Staff::create([
                'name' => $step2Validated['staff_username'],
                'role' => $step2Validated['staff_role'],
                'contact' => $step2Validated['staff_contact'],
                'assigned_bank_id' => $step2Validated['blood_bank_id'] ?? null,
            ]);
        }

        // Clear session data
        session()->forget('register_step1');

        // Fire registered event
        event(new Registered($user));

        // Login user
        Auth::login($user);

        // Redirect donors to profile, others to dashboard
        $redirectRoute = auth()->user()->role === 'donor' 
            ? route('profile.edit') 
            : route('dashboard');

        return redirect($redirectRoute)->with('success', 'Account created successfully!');
    }

    /**
     * Clear registration session and redirect to login
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearRegistration()
    {
        session()->forget('register_step1');
        return redirect()->route('login')->with('info', 'Registration cancelled. Please login to your account.');
    }
}
