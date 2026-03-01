<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index()
    {
        $donors = Donor::all();
        return view('donors.index', ['donors' => $donors]);
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
            'blood_type' => 'required|string',
            'contact' => 'required|string',
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
            'blood_type' => 'required|string',
            'contact' => 'required|string',
        ]);

        $donor->update($validated);
        return redirect()->route('donors.show', $donor)->with('success', 'Donor updated successfully!');
    }

    public function destroy(Donor $donor)
    {
        $donor->delete();
        return redirect()->route('donors.index')->with('success', 'Donor deleted successfully!');
    }
}
