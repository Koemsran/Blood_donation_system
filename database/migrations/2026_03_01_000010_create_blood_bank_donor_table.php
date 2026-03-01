<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_bank_donor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blood_bank_id')->constrained('blood_banks')->onDelete('cascade');
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_bank_donor');
    }
};
