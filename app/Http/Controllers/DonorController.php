<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;

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

    public function create()
    {
        return view('donors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:65',
            'blood_type' => 'required|string|max:10',
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
            'age' => 'required|integer|min:18|max:65',
            'blood_type' => 'required|string|max:10',
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
