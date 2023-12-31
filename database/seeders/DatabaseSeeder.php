<?php

namespace Database\Seeders;

use App\Models\FormEntry;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'test123',
        ]);

        FormEntry::factory()->count(5)->create();
    }
}
