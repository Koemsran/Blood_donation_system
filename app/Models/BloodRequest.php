<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    protected $fillable = [
        'hospital_id',
        'patient_id',
        'blood_type',
        'quantity',
        'request_date',
        'status',
    ];

    protected $casts = [
        'request_date' => 'datetime',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function updateRequestStatus(string $status): void
    {
        $this->update(['status' => $status]);
    }

    public function cancelRequest(): void
    {
        $this->updateRequestStatus('cancelled');
    }
}
