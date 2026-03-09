<?php

namespace App\Http\Controllers;

use App\Enums\BloodType;
use App\Models\BloodDonation;
use App\Models\Donor;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $pendingApprovals = BloodDonation::query()
            ->with('donor:id,name')
            ->where('status', 'pending')
            ->when(auth()->user()->role === 'staff', function ($query) {
                // Get the staff member's assigned blood bank
                $staff = Staff::where('name', auth()->user()->name)->first();
                if ($staff && $staff->assigned_bank_id) {
                    return $query->where('blood_bank_id', $staff->assigned_bank_id);
                }
                return $query;
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('id', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhereHas('donor', function ($donorQuery) use ($search) {
                            $donorQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('donation_date')
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        $donationHistory = BloodDonation::query()
            ->with(['donor:id,name', 'verifier:id,name'])
            ->where('status', 'completed')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('id', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhereHas('donor', function ($donorQuery) use ($search) {
                            $donorQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('donation_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $donors = Donor::query()->orderBy('name')->get(['id', 'name', 'blood_type']);

        return view('donations.index', [
            'pendingApprovals' => $pendingApprovals,
            'donationHistory' => $donationHistory,
            'donors' => $donors,
            'search' => $search,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'blood_group' => ['required', Rule::in(BloodType::values())],
            'donation_date' => 'required|date',
            'unit_volume' => 'required|integer|min:100|max:1000',
            'location' => 'required|string|max:255',
            'blood_bank_id' => 'nullable|exists:blood_banks,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        $validated['status'] = 'pending';

        BloodDonation::create($validated);

        // Redirect to donor request page if user is a donor, otherwise to admin donations page
        if (auth()->user()->role === 'donor') {
            return redirect()->route('donors.request-donation')->with('success', 'Donation recorded and waiting for approval.');
        }

        return redirect()->route('donations.index')->with('success', 'Donation recorded and waiting for approval.');
    }

    public function updateStatus(Request $request, BloodDonation $donation)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'completed', 'rejected'])],
        ]);

        $payload = [
            'status' => $validated['status'],
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ];

        if ($validated['status'] === 'pending') {
            $payload['verified_by'] = null;
            $payload['verified_at'] = null;
        }

        $donation->update($payload);

        // Redirect to donor request page if user is a donor, otherwise to admin donations page
        if (auth()->user()->role === 'donor') {
            return redirect()->route('donors.request-donation')->with('success', 'Donation status updated.');
        }

        return redirect()->route('donations.index')->with('success', 'Donation status updated.');
    }
}
