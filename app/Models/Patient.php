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
}
