<?php

namespace App\Http\Controllers;

use App\Enums\BloodType;
use App\Models\BloodBank;
use App\Models\BloodDonation;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $bloodType = trim((string) $request->query('blood_type', ''));
        $status = trim((string) $request->query('status', ''));

        $threeMonthsAgo = now()->subMonths(3);

        $donors = Donor::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('contact', 'like', "%{$search}%")
                        ->orWhere('blood_type', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%");
                });
            })
            ->when($bloodType !== '', function ($query) use ($bloodType) {
                $query->where('blood_type', $bloodType);
            })
            ->when($status === 'eligible', function ($query) use ($threeMonthsAgo) {
                $query->where(function ($innerQuery) use ($threeMonthsAgo) {
                    $innerQuery
                        ->whereNull('last_donation_date')
                        ->orWhere('last_donation_date', '<', $threeMonthsAgo);
                });
            })
            ->when($status === 'deferred', function ($query) use ($threeMonthsAgo) {
                $query->whereNotNull('last_donation_date')
                    ->where('last_donation_date', '>=', $threeMonthsAgo);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalDonors = Donor::count();
        $eligibleToday = Donor::query()
            ->where(function ($query) use ($threeMonthsAgo) {
                $query
                    ->whereNull('last_donation_date')
                    ->orWhere('last_donation_date', '<', $threeMonthsAgo);
            })
            ->count();

        $pendingScreening = Donor::query()
            ->whereNotNull('last_donation_date')
            ->where('last_donation_date', '>=', $threeMonthsAgo)
            ->count();

        $weeklyDonations = Donor::query()
            ->whereNotNull('last_donation_date')
            ->where('last_donation_date', '>=', now()->subDays(7))
            ->count();

        $bloodTypes = Donor::query()
            ->select('blood_type')
            ->distinct()
            ->orderBy('blood_type')
            ->pluck('blood_type');

        return view('donors.index', [
            'donors' => $donors,
            'search' => $search,
            'bloodType' => $bloodType,
            'status' => $status,
            'bloodTypes' => $bloodTypes,
            'totalDonors' => $totalDonors,
            'eligibleToday' => $eligibleToday,
            'pendingScreening' => $pendingScreening,
            'weeklyDonations' => $weeklyDonations,
        ]);
    }

    public function donationHistory(Request $request)
    {
        $donationHistory = BloodDonation::query()
            ->with(['donor:id,name', 'verifier:id,name'])
            ->where('status', 'completed')
            ->orderByDesc('donation_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('donors.history', ['donationHistory' => $donationHistory]);
    }

    public function requestDonation(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $pendingApprovals = BloodDonation::query()
            ->with('donor:id,name')
            ->where('status', 'pending')
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

        // Get current user's donor profile by matching name
        $currentUserDonor = Donor::where('name', auth()->user()->name)->first();
        
        // Get all blood banks
        $bloodBanks = BloodBank::all();

        return view('donors.request-donation', [
            'pendingApprovals' => $pendingApprovals,
            'currentUserDonor' => $currentUserDonor,
            'bloodBanks' => $bloodBanks,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('donors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'blood_type' => ['required', Rule::in(BloodType::values())],
            'contact' => 'required|string',
            'last_donation_date' => 'nullable|date',
        ]);

        Donor::create($validated);
        return redirect()->route('donors.index')->with('success', 'Donor registered successfully!');
    }

    public function show(Donor $donor)
    {
        return view('donors.show', ['donor' => $donor]);
    }

    public function edit(Donor $donor)
    {
        return view('donors.edit', ['donor' => $donor]);
    }

    public function update(Request $request, Donor $donor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'blood_type' => ['required', Rule::in(BloodType::values())],
            'contact' => 'required|string',
            'last_donation_date' => 'nullable|date',
        ]);

        $donor->update($validated);
        return redirect()->route('donors.index')->with('success', 'Donor updated successfully!');
    }

    public function destroy(Donor $donor)
    {
        $donor->delete();
        return redirect()->route('donors.index')->with('success', 'Donor deleted successfully!');
    }
}
