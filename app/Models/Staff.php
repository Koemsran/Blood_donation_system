<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'name',
        'role',
        'contact',
        'assigned_bank_id',
    ];

    public function assignedBank()
    {
        return $this->belongsTo(BloodBank::class, 'assigned_bank_id');
    }
}
