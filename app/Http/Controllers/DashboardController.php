<?php

namespace App\Http\Controllers;

use App\Models\BloodDonation;
use App\Models\BloodRequest;
use App\Models\BloodStock;
use App\Models\Donor;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBloodStock = (int) BloodStock::sum('quantity');
        $pendingRequestsCount = BloodDonation::where('status', 'pending')->count();
        $todaysDonors = Donor::query()
            ->whereDate('created_at', now()->toDateString())
            ->count();

        $inventoryByType = BloodStock::query()
            ->selectRaw('blood_type, SUM(quantity) as total_units')
            ->groupBy('blood_type')
            ->orderBy('blood_type')
            ->get();

        $maxInventoryUnit = (int) ($inventoryByType->max('total_units') ?? 0);

        $recentDonations = BloodDonation::query()
            ->with('donor:id,name')
            ->orderByDesc('donation_date')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $pendingRequests = BloodRequest::query()
            ->with('hospital:id,name')
            ->where('status', 'pending')
            ->orderByDesc('request_date')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        return view('dashboard', [
            'totalBloodStock' => $totalBloodStock,
            'pendingRequestsCount' => $pendingRequestsCount,
            'todaysDonors' => $todaysDonors,
            'inventoryByType' => $inventoryByType,
            'maxInventoryUnit' => max($maxInventoryUnit, 1),
            'recentDonations' => $recentDonations,
            'pendingRequests' => $pendingRequests,
        ]);
    }
}
