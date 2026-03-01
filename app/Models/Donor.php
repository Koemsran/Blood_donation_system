<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'name',
        'age',
        'blood_type',
        'contact',
        'last_donation_date',
    ];

    protected $casts = [
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
}
