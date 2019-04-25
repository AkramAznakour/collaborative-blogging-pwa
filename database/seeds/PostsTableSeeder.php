<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 100; $i++) {

            $user_id = App\User::all()->random(1)->first()->id;
            $topic_id = App\Topic::all()->random(1)->first()->id;

            App\Post::create([
                'title' => $faker->sentence(5),
                'user_id' => $user_id,
                'topic_id' => $topic_id,
                'content'=> $faker->realText(50000),
                'image'=> $faker->numberBetween(1,17).".jpg",
                'created_at'=> $faker->dateTime,
            ]);
        }
    }
}
