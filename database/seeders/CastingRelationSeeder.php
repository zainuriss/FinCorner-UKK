<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CastingRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $faker = Faker::create();
        $film_ids = DB::table('films')->pluck('id')->toArray();
        $casting_ids = DB::table('castings')->pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            DB::table('casting_relations')->insert([
                'film_id' => $faker->randomElement($film_ids),
                'casting_id' => $faker->randomElement($casting_ids),
                'character_name' => $faker->name,
            ]);
        }
    }
}
