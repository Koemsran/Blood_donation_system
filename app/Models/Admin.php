<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'username',
        'email',
    ];

    public function manageUsers()
    {
        // Method to manage users
    }

    public function manageBloodStock()
    {
        // Method to manage blood stock
    }

    public function generateReports()
    {
        // Method to generate reports
    }
}
