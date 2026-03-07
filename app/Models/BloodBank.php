<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodBank extends Model
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

    public function addBloodStock(string $bloodType, int $quantity, ?string $expiryDate = null): BloodStock
    {
        return $this->bloodStocks()->create([
            'blood_type' => $bloodType,
            'quantity' => $quantity,
            'expiry_date' => $expiryDate,
        ]);
    }

    public function checkAvailability(string $bloodType): int
    {
        return $this->bloodStocks()
            ->where('blood_type', $bloodType)
            ->where('expiry_date', '>', now())
            ->sum('quantity');
    }
}
