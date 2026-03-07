<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'age',
        'blood_type',
        'hospital_id',
        'contact',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function bloodRequests()
    {
        return $this->hasMany(BloodRequest::class);
    }

    public function requestBlood(string $bloodType, int $quantity): BloodRequest
    {
        return $this->bloodRequests()->create([
            'hospital_id' => $this->hospital_id,
            'blood_type' => $bloodType,
            'quantity' => $quantity,
            'request_date' => now(),
            'status' => 'pending',
        ]);
    }

    public function viewRequestStatus()
    {
        return $this->bloodRequests()->orderBy('request_date', 'desc')->get();
    }
}
