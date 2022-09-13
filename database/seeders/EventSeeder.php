<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($count = 0; $count < 10; $count++) {
            DB::table("events")->insert([
                'id' => $faker->unique()->uuid,
                'name' => $faker->name,
                'slug' => $faker->unique()->slug,
                'startAt' => $faker->unique()->dateTimeBetween($startDate = "-30 days", $endDate = "now")->format('Y-m-d H:i:s'),
                'endAt' =>  $faker->unique()->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
