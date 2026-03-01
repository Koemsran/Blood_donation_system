<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodStock extends Model
{
    protected $fillable = [
        'blood_bank_id',
        'blood_type',
        'quantity',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'datetime',
    ];

    public function bloodBank()
    {
        return $this->belongsTo(BloodBank::class);
    }

    public function updateStock($quantity)
    {
        $this->quantity += $quantity;
        $this->save();
    }

    public function checkExpiry()
    {
        return $this->expiry_date > now();
    }

    public function removeStock($quantity)
    {
        $this->quantity -= $quantity;
        $this->save();
    }
}
