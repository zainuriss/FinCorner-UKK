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
            'telepon' => '08123456789',
            'name' => 'Test Admin',
            'email' => 'test@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::factory()->create([
            'telepon' => '08123456789',
            'name' => 'Test Author',
            'email' => 'test@author.com',
            'password' => Hash::make('password'),
            'role' => 'author',

        ]);
        User::factory()->create([
            'telepon' => '08123456789',
            'name' => 'Mang Author',
            'email' => 'mang@author.com',
            'password' => Hash::make('password'),
            'role' => 'author',
        ]);
        User::factory()->create([
            'telepon' => '08123456789',
            'name' => 'Test Subscriber',
            'email' => 'test@subscriber.com',
            'password' => Hash::make('password'),
            'role' => 'subscriber',
        ]);

        $this->call([
            FilmSeeder::class,
            GenreSeeder::class,
            CastingSeeder::class,
            CastingRelationSeeder::class,
            GenreRelationSeeder::class
        ]);
    }
}
