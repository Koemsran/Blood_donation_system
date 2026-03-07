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

    public function processBloodRequest(BloodRequest $request, string $status): void
    {
        $request->updateRequestStatus($status);
    }

    public function updateStock(string $bloodType, int $quantity): ?BloodStock
    {
        $stock = $this->assignedBank?->bloodStocks()
            ->where('blood_type', $bloodType)
            ->first();

        $stock?->updateStock($quantity);

        return $stock;
    }
}
