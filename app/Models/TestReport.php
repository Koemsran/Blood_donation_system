<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    protected $fillable = [
        'donor_id',
        'blood_type',
        'test_date',
        'result',
    ];

    protected $casts = [
        'test_date' => 'datetime',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
}
