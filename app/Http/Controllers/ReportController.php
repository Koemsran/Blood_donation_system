<?php

namespace App\Http\Controllers;

use App\Models\BloodDonation;
use App\Models\BloodRequest;
use App\Models\BloodStock;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $months = (int) $request->query('months', 6);
        if (!in_array($months, [3, 6, 12], true)) {
            $months = 6;
        }

        $startDate = now()->subMonths($months - 1)->startOfMonth();

        $totalDonations = BloodDonation::query()
            ->whereDate('donation_date', '>=', $startDate)
            ->count();

        $totalRequests = BloodRequest::query()
            ->whereDate('request_date', '>=', $startDate)
            ->count();

        $fulfilledRequests = BloodRequest::query()
            ->whereDate('request_date', '>=', $startDate)
            ->whereIn('status', ['approved', 'completed'])
            ->count();

        $fulfillmentRate = $totalRequests > 0 ? round(($fulfilledRequests / $totalRequests) * 100, 1) : 0;

        $avgFulfillmentHours = round((float) BloodRequest::query()
            ->whereDate('request_date', '>=', $startDate)
            ->whereIn('status', ['approved', 'completed'])
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, request_date, updated_at)) as avg_hours')
            ->value('avg_hours'), 1);

        $criticalStockShortage = BloodStock::query()
            ->selectRaw('blood_type, SUM(quantity) as total_units')
            ->groupBy('blood_type')
            ->havingRaw('SUM(quantity) < 50')
            ->count();

        $donationTrends = BloodDonation::query()
            ->selectRaw("DATE_FORMAT(donation_date, '%Y-%m') as month_key")
            ->selectRaw('SUM(unit_volume) as total_units')
            ->whereDate('donation_date', '>=', $startDate)
            ->groupBy('month_key')
            ->orderBy('month_key')
            ->get();

        $requestVsFulfillment = BloodRequest::query()
            ->selectRaw('blood_type')
            ->selectRaw('SUM(quantity) as requested_units')
            ->selectRaw("SUM(CASE WHEN status IN ('approved','completed') THEN quantity ELSE 0 END) as fulfilled_units")
            ->whereDate('request_date', '>=', $startDate)
            ->groupBy('blood_type')
            ->orderBy('blood_type')
            ->get();

        $recentLogs = BloodRequest::query()
            ->with('hospital:id,name')
            ->orderByDesc('request_date')
            ->limit(8)
            ->get();

        return view('reports.index', [
            'months' => $months,
            'totalDonations' => $totalDonations,
            'fulfillmentRate' => $fulfillmentRate,
            'avgFulfillmentHours' => $avgFulfillmentHours,
            'criticalStockShortage' => $criticalStockShortage,
            'donationTrends' => $donationTrends,
            'requestVsFulfillment' => $requestVsFulfillment,
            'recentLogs' => $recentLogs,
        ]);
    }
}
