<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'name',
        'date_of_birth',
        'blood_type',
        'contact',
        'last_donation_date',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'last_donation_date' => 'datetime',
    ];

    public function bloodBanks()
    {
        return $this->belongsToMany(BloodBank::class, 'blood_bank_donor');
    }

    public function testReports()
    {
        return $this->hasMany(TestReport::class);
    }

    public function donateBlood(): void
    {
        $this->update(['last_donation_date' => now()]);
    }

    public function viewDonationHistory()
    {
        return $this->testReports()->orderBy('test_date', 'desc')->get();
    }
}
