<?php

namespace App\Http\Controllers;

use App\Enums\BloodType;
use App\Models\BloodRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BloodRequestController extends Controller
{
    public function index()
    {
        $requests = BloodRequest::with('patient')->get();
        return view('blood-requests.index', ['requests' => $requests]);
    }

    public function create()
    {
        $patients = Patient::all();
        return view('blood-requests.create', ['patients' => $patients]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'blood_type' => ['required', Rule::in(BloodType::values())],
            'quantity' => 'required|integer|min:1',
        ]);

        BloodRequest::create($validated);
        return redirect()->route('blood-requests.index')->with('success', 'Blood request created successfully!');
    }

    public function show(BloodRequest $bloodRequest)
    {
        return view('blood-requests.show', ['request' => $bloodRequest]);
    }

    public function updateStatus(Request $request, BloodRequest $bloodRequest)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,approved,rejected,completed,cancelled',
        ]);

        $bloodRequest->updateRequestStatus($validated['status']);
        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function destroy(BloodRequest $bloodRequest)
    {
        $bloodRequest->delete();
        return redirect()->route('blood-requests.index')->with('success', 'Blood request deleted successfully!');
    }
}
