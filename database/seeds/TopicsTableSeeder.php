<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            App\Topic::create([
                'name' => $faker->sentence(3),
            ]);
        }
    }
}
