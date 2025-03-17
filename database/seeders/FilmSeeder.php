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
use Illuminate\Support\Str;

class FilmSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $creator_id = User::where('role', 'author')->pluck('id')->toArray();

        $films = [
            [
                'id' => Str::uuid(),
                'title' => 'Inception',
                'slug' => Str::slug('Inception'),
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'release_year' => 2010,
                'age_rating' => 'PG-13',
                'duration' => 148,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=YoHD9XEInc0',
                'poster' => 'https://images.unsplash.com/photo-1635776062360-af423602aff3?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'id' => Str::uuid(),
                'title' => 'The Dark Knight',
                'slug' => Str::slug('The Dark Knight'),
                'description' => 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.',
                'release_year' => 2008,
                'age_rating' => 'PG-13',
                'duration' => 152,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=EXeTwQWrcwY',
                'poster' => 'https://images.unsplash.com/photo-1635776062360-af423602aff3?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Interstellar',
                'slug' => Str::slug('Interstellar'),
                'description' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
                'release_year' => 2014,
                'age_rating' => 'PG-13',
                'duration' => 169,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=zSWdZVtXT7E',
                'poster' => 'https://images.unsplash.com/photo-1635776062360-af423602aff3?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'id' => Str::uuid(),
                'title' => 'The Matrix',
                'slug' => Str::slug('The Matrix'),
                'description' => 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.',
                'release_year' => 1999,
                'age_rating' => 'R',
                'duration' => 136,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=vKQi3bBA1y8',
                'poster' => 'https://images.unsplash.com/photo-1635776062360-af423602aff3?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Avatar',
                'slug' => Str::slug('Avatar'),
                'description' => 'A paraplegic Marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.',
                'release_year' => 2009,
                'age_rating' => 'PG-13',
                'duration' => 162,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=5PSNL1qE6VY',
                'poster' => 'https://images.unsplash.com/photo-1635776062360-af423602aff3?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
        ];

        foreach ($films as $film) {
            Film::create($film);
        }
    }
}
