<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CastingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $film_ids = DB::table('films')->pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            DB::table('castings')->insert([
                'real_name' => $faker->name,
                'stage_name' => $faker->unique()->userName,
                'film_id' => $faker->randomElement($film_ids),
            ]);
        }
    }
}
