<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        'admin_id',
        'name',
        'location',
        'contact',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function bloodRequests()
    {
        return $this->hasMany(BloodRequest::class);
    }

    public function placeBloodRequest(int $patientId, string $bloodType, int $quantity): BloodRequest
    {
        return $this->bloodRequests()->create([
            'patient_id' => $patientId,
            'blood_type' => $bloodType,
            'quantity' => $quantity,
            'request_date' => now(),
            'status' => 'pending',
        ]);
    }
}
