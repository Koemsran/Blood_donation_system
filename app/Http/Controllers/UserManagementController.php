<?php

namespace App\Http\Controllers;

use App\Enums\BloodType;
use App\Models\Donor;
use App\Models\BloodBank;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $role = (string) $request->query('role', '');
        $status = (string) $request->query('status', '');

        $users = User::query()
            ->when(Auth::id(), function ($query, $authId) {
                $query->whereKeyNot($authId);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%");
                });
            })
            ->when(in_array($role, ['admin', 'donor', 'staff'], true), function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->when($status === 'verified', function ($query) {
                $query->whereNotNull('email_verified_at');
            })
            ->when($status === 'unverified', function ($query) {
                $query->whereNull('email_verified_at');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $bloodBanks = BloodBank::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('users.index', [
            'users' => $users,
            'search' => $search,
            'role' => $role,
            'status' => $status,
            'bloodBanks' => $bloodBanks,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => ['required', Rule::in(['donor', 'admin', 'staff'])],
        ]);

        $user = User::create($validated);

        if ($request->expectsJson()) {
            if ($user->role === 'donor') {
                return response()->json([
                    'next_step' => 'donor_profile',
                    'message' => 'User created. Complete donor profile details.',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                ], 201);
            }

            if ($user->role === 'staff') {
                return response()->json([
                    'next_step' => 'staff_profile',
                    'message' => 'User created. Complete staff profile details.',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                ], 201);
            }

            return response()->json([
                'next_step' => null,
                'message' => 'User created successfully.',
            ], 201);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function storeDonorProfile(Request $request, User $user)
    {
        $request->validate([
            'age' => 'required|integer|min:18|max:65',
            'blood_type' => ['required', Rule::in(BloodType::values())],
            'contact' => 'required|string|max:255',
            'last_donation_date' => 'nullable|date',
        ]);

        Donor::create([
            'name' => $user->name,
            'age' => (int) $request->input('age'),
            'blood_type' => (string) $request->input('blood_type'),
            'contact' => (string) $request->input('contact'),
            'last_donation_date' => $request->input('last_donation_date') ?: null,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Donor profile created successfully.',
            ], 201);
        }

        return redirect()->route('users.index')->with('success', 'Donor profile created successfully.');
    }

    public function storeStaffProfile(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'assigned_bank_id' => 'nullable|integer|exists:blood_banks,id',
        ]);

        Staff::create([
            'name' => $user->name,
            'role' => (string) $request->input('role'),
            'contact' => (string) $request->input('contact'),
            'assigned_bank_id' => $request->input('assigned_bank_id') ?: null,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Staff profile created successfully.',
            ], 201);
        }

        return redirect()->route('users.index')->with('success', 'Staff profile created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $previousRole = $user->role;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(['donor', 'admin', 'staff'])],
        ]);

        $user->update($validated);

        if ($request->expectsJson()) {
            $isAdminMigration = $previousRole === 'admin' && in_array($user->role, ['donor', 'staff'], true);

            if ($isAdminMigration && $user->role === 'donor') {
                return response()->json([
                    'next_step' => 'donor_profile',
                    'message' => 'User updated. Complete donor profile details.',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                ]);
            }

            if ($isAdminMigration && $user->role === 'staff') {
                return response()->json([
                    'next_step' => 'staff_profile',
                    'message' => 'User updated. Complete staff profile details.',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                ]);
            }

            return response()->json([
                'next_step' => null,
                'message' => 'User updated successfully.',
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
