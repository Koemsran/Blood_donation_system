<?php

namespace App\Http\Controllers;

use App\Models\BloodBank;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $role = trim((string) $request->query('role', ''));

        $staffMembers = Staff::query()
            ->with('assignedBank')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('contact', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%");
                });
            })
            ->when($role !== '', function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalStaff = Staff::count();
        $activeStaff = Staff::whereNotNull('assigned_bank_id')->count();
        $pendingAssignments = Staff::whereNull('assigned_bank_id')->count();

        $roleOptions = Staff::query()
            ->select('role')
            ->distinct()
            ->orderBy('role')
            ->pluck('role');

        $bloodBanks = BloodBank::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('staff.index', [
            'staffMembers' => $staffMembers,
            'search' => $search,
            'role' => $role,
            'roleOptions' => $roleOptions,
            'bloodBanks' => $bloodBanks,
            'totalStaff' => $totalStaff,
            'activeStaff' => $activeStaff,
            'pendingAssignments' => $pendingAssignments,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'assigned_bank_id' => 'nullable|integer|exists:blood_banks,id',
        ]);

        Staff::create($validated);

        return redirect()->route('staff.index')->with('success', 'Staff member created successfully.');
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'assigned_bank_id' => 'nullable|integer|exists:blood_banks,id',
        ]);

        $staff->update($validated);

        return redirect()->route('staff.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff member deleted successfully.');
    }
}
