<?php

namespace App\Http\Controllers;

use App\Models\BloodBank;
use Illuminate\Http\Request;

class BloodBankController extends Controller
{
    public function index()
    {
        $banks = BloodBank::with('bloodStocks')->get();
        return view('blood-banks.index', ['banks' => $banks]);
    }

    public function create()
    {
        return view('blood-banks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact' => 'required|string',
        ]);

        BloodBank::create($validated);
        return redirect()->route('blood-banks.index')->with('success', 'Blood bank created successfully!');
    }

    public function show(BloodBank $bloodBank)
    {
        $bloodBank->load('bloodStocks', 'staff');
        return view('blood-banks.show', ['bank' => $bloodBank]);
    }

    public function edit(BloodBank $bloodBank)
    {
        return view('blood-banks.edit', ['bank' => $bloodBank]);
    }

    public function update(Request $request, BloodBank $bloodBank)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact' => 'required|string',
        ]);

        $bloodBank->update($validated);
        return redirect()->route('blood-banks.show', $bloodBank)->with('success', 'Blood bank updated successfully!');
    }

    public function destroy(BloodBank $bloodBank)
    {
        $bloodBank->delete();
        return redirect()->route('blood-banks.index')->with('success', 'Blood bank deleted successfully!');
    }
}
