<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Action', 'Adventure', 'Animation', 'Biography', 'Comedy', 'Crime', 'Documentary',
            'Drama', 'Family', 'Fantasy', 'History', 'Horror', 'Music', 'Musical',
            'Mystery', 'Romance', 'Sci-Fi', 'Sport', 'Thriller', 'War', 'Western',
            'Superhero', 'Noir', 'Psychological', 'Suspense', 'Anime', 'Teen', 'Disaster', 'Experimental'
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'title' => $genre,
                'slug' => Str::slug($genre),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
