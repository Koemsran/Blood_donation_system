<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
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

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:donor,staff',
            'gender' => 'required|in:male,female,other,prefer_not',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'blood_group' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'last_donation_date' => 'nullable|date',
            'weight' => 'nullable|numeric|min:30|max:300',
            'available_time' => 'nullable|in:morning,afternoon,evening,anytime',
            'willing_to_donate' => 'required|in:yes,no,maybe',
            'consent' => 'required|accepted',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'] ?? 'donor',
            'gender' => $validated['gender'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'address' => $validated['address'] ?? null,
            'blood_group' => $validated['blood_group'] ?? null,
            'last_donation_date' => $validated['last_donation_date'] ?? null,
            'weight' => $validated['weight'] ?? null,
            'available_time' => $validated['available_time'] ?? null,
            'willing_to_donate' => $validated['willing_to_donate'] ?? null,
        ]);

        event(new Registered($user));

        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }
}
