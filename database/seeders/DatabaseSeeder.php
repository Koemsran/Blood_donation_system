<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 1 admin user
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@blood-donation.test',
        ]);

        // Create 4 regular users
        User::factory()->create([
            'name' => 'John Donor',
            'email' => 'john@blood-donation.test',
        ]);

        User::factory()->create([
            'name' => 'Maria Garcia',
            'email' => 'maria@blood-donation.test',
        ]);

        User::factory()->create([
            'name' => 'Ahmed Hassan',
            'email' => 'ahmed@blood-donation.test',
        ]);

        User::factory()->create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah@blood-donation.test',
        ]);
    }
}
