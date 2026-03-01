<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodBank extends Model
{
    protected $fillable = [
        'name',
        'location',
        'contact',
    ];

    public function bloodStocks()
    {
        return $this->hasMany(BloodStock::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'assigned_bank_id');
    }

    public function donors()
    {
        return $this->belongsToMany(Donor::class, 'blood_bank_donor');
    }
}
