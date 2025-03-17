<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class GenreRelationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $film_ids = DB::table('films')->pluck('id')->toArray();
        $genre_ids = DB::table('genres')->pluck('id')->toArray();

        foreach ($film_ids as $film_id) {
            $randomGenres = $faker->randomElements($genre_ids, $faker->numberBetween(1, count($genre_ids)));
            foreach ($randomGenres as $genre_id) {
                DB::table('genre_relations')->insert([
                    'film_id' => $film_id,
                    'genre_id' => $genre_id,
                ]);
            }
        }
    }
}
