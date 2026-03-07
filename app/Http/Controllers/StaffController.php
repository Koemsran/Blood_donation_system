<?php

namespace App\Http\Controllers;

use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        $staffMembers = Staff::query()->latest()->take(4)->get();

        return view('staff.index', [
            'staffMembers' => $staffMembers,
        ]);
    }
}
