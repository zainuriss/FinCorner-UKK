<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'test@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Test Author',
            'email' => 'test@author.com',
            'password' => Hash::make('password'),
            'role' => 'author',
        ]);
        User::factory()->create([
            'name' => 'Test Subscriber',
            'email' => 'test@subscriber.com',
            'password' => Hash::make('password'),
            'role' => 'subscriber',
        ]);
    }
}
