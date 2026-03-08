<?php

namespace Database\Seeders;

use App\Models\BloodBank;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        BloodBank::query()->updateOrCreate(
            ['name' => 'Central Blood Bank'],
            ['location' => 'Phnom Penh', 'contact' => '+855-12-000-001']
        );

        BloodBank::query()->updateOrCreate(
            ['name' => 'North Regional Blood Bank'],
            ['location' => 'Siem Reap', 'contact' => '+855-12-000-002']
        );

        BloodBank::query()->updateOrCreate(
            ['name' => 'South Medical Blood Bank'],
            ['location' => 'Sihanoukville', 'contact' => '+855-12-000-003']
        );
    }
}
