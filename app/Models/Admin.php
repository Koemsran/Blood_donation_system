<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'username',
        'email',
    ];

    public function bloodBanks()
    {
        return $this->hasMany(BloodBank::class);
    }

    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }
}
