<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\User;
use Faker\Factory as Faker;
use Faker\Provider\Youtube;
use Illuminate\Database\Seeder;
use Xylis\FakerCinema\Provider\Movie;
use Xylis\FakerCinema\Provider\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $faker->addProvider(new Movie($faker));
        $faker->addProvider(new Person($faker));
        $faker->addProvider(new Youtube($faker));
        $creator_id = User::where('role', 'author')->pluck('id')->toArray();

        for ($i = 0; $i <= 20; $i++) {
            $films = Film::create([
                'title' => $faker->movie(),
                'description' => $faker->overview(),
                'release_year' => $faker->year(),
                'age_rating' => $faker->randomElement(['G', 'PG', 'R', 'PG-13', 'NC-17']),
                'duration' => $faker->numberBetween(60, 180), // duration in minutes
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => "https://www.youtube.com/watch?v=uXlWYZ022zU",
                'poster' => "https://images.unsplash.com/photo-1635776062360-af423602aff3?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            ]);
        }
    }
}
