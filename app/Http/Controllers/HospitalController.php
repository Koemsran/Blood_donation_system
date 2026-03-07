<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $status = trim((string) $request->query('status', ''));

        $hospitals = Hospital::query()
            ->withCount('bloodRequests')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('contact', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%");
                });
            })
            ->when($status === 'active', function ($query) {
                $query->has('bloodRequests');
            })
            ->when($status === 'inactive', function ($query) {
                $query->doesntHave('bloodRequests');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalHospitals = Hospital::count();
        $activeBloodRequests = BloodRequest::count();
        $avgFulfillmentHours = BloodRequest::query()
            ->whereIn('status', ['approved', 'completed'])
            ->whereNotNull('request_date')
            ->get()
            ->avg(function (BloodRequest $requestModel) {
                if (!$requestModel->updated_at || !$requestModel->request_date) {
                    return null;
                }

                return $requestModel->request_date->diffInHours($requestModel->updated_at);
            });

        return view('hospitals.index', [
            'hospitals' => $hospitals,
            'search' => $search,
            'status' => $status,
            'totalHospitals' => $totalHospitals,
            'activeBloodRequests' => $activeBloodRequests,
            'avgFulfillmentHours' => $avgFulfillmentHours,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ]);

        Hospital::create($validated);

        return redirect()->route('hospitals.index')->with('success', 'Hospital created successfully.');
    }

    public function update(Request $request, Hospital $hospital)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ]);

        $hospital->update($validated);

        return redirect()->route('hospitals.index')->with('success', 'Hospital updated successfully.');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();

        return redirect()->route('hospitals.index')->with('success', 'Hospital deleted successfully.');
    }
}
