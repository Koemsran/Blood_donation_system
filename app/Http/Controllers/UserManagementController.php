<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::query()->latest()->take(4)->get();

        return view('users.index', [
            'users' => $users,
        ]);
    }
}
