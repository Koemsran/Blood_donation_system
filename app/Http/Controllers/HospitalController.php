<?php

namespace App\Http\Controllers;

use App\Models\Hospital;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::query()
            ->withCount('bloodRequests')
            ->latest()
            ->take(4)
            ->get();

        return view('hospitals.index', [
            'hospitals' => $hospitals,
        ]);
    }
}
