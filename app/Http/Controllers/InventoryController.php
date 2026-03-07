<?php

namespace App\Http\Controllers;

use App\Models\BloodBank;
use App\Models\BloodStock;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $stocks = BloodStock::query()
            ->with('bloodBank:id,name')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('blood_type', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%")
                        ->orWhereHas('bloodBank', function ($bankQuery) use ($search) {
                            $bankQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        $totalUnits = (int) BloodStock::sum('quantity');

        $lowStockTypes = BloodStock::query()
            ->selectRaw('blood_type, SUM(quantity) as total_units')
            ->groupBy('blood_type')
            ->havingRaw('SUM(quantity) < 80')
            ->count();

        $expiringSoonUnits = (int) BloodStock::query()
            ->whereNotNull('expiry_date')
            ->whereBetween('expiry_date', [now(), now()->addHours(48)])
            ->sum('quantity');

        $recentTransactions = BloodStock::query()
            ->with('bloodBank:id,name')
            ->latest('updated_at')
            ->limit(4)
            ->get();

        $expirationAlerts = BloodStock::query()
            ->whereNotNull('expiry_date')
            ->whereBetween('expiry_date', [now(), now()->addDays(5)])
            ->orderBy('expiry_date')
            ->limit(4)
            ->get();

        $bloodBanks = BloodBank::query()->orderBy('name')->get(['id', 'name']);

        return view('inventory', [
            'stocks' => $stocks,
            'search' => $search,
            'totalUnits' => $totalUnits,
            'lowStockTypes' => $lowStockTypes,
            'expiringSoonUnits' => $expiringSoonUnits,
            'recentTransactions' => $recentTransactions,
            'expirationAlerts' => $expirationAlerts,
            'bloodBanks' => $bloodBanks,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'blood_bank_id' => 'required|exists:blood_banks,id',
            'blood_type' => 'required|string|max:10',
            'quantity' => 'required|integer|min:1',
            'expiry_date' => 'nullable|date',
        ]);

        BloodStock::create($validated);

        return redirect()->route('inventory.index')->with('success', 'Stock record added successfully.');
    }

    public function update(Request $request, BloodStock $bloodStock)
    {
        $validated = $request->validate([
            'blood_bank_id' => 'required|exists:blood_banks,id',
            'blood_type' => 'required|string|max:10',
            'quantity' => 'required|integer|min:1',
            'expiry_date' => 'nullable|date',
        ]);

        $bloodStock->update($validated);

        return redirect()->route('inventory.index')->with('success', 'Stock record updated successfully.');
    }
}
