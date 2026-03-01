<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        'name',
        'location',
        'contact',
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function bloodRequests()
    {
        return $this->hasMany(BloodRequest::class);
    }

    public function placeBloodRequest()
    {
        // Method to place blood request
    }

    public function receiveBloodSupply()
    {
        // Method to receive blood supply
    }
}
