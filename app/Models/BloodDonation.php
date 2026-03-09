<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodDonation extends Model
{
    protected $fillable = [
        'donor_id',
        'blood_group',
        'donation_date',
        'unit_volume',
        'location',
        'blood_bank_id',
        'status',
        'verified_by',
        'verified_at',
        'notes',
    ];

    protected $casts = [
        'donation_date' => 'date',
        'verified_at' => 'datetime',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
