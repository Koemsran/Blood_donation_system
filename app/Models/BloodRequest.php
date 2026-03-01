<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    protected $fillable = [
        'patient_id',
        'blood_type',
        'quantity',
        'request_date',
        'status',
    ];

    protected $casts = [
        'request_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function createRequest()
    {
        // Method to create blood request
    }

    public function updateRequestStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function cancelRequest()
    {
        $this->updateRequestStatus('cancelled');
    }
}
