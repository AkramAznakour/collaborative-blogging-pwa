<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('comments')->insert([
            'id' => '1',
            'title' => 'Excellent article mate!',
            'content' => ' <p> I found it super useful as I am somehow new into development and sometimes I struggle with CSS to the point that I hate it.</p> <p>I’m going to start following these 15 steps, hopefully I’ll get more confident at CSS.</p> <p>Thanks for sharing it!</p> ',
            'post_id' => '9',
            'user_id' => '5',
            'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')->format('Y-m-d H:i:s'),
        ]);

        DB::table('comments')->insert([
            'id' => '2',
            'title' => ' Useful article, thank you!',
            'content' => ' <p>I am a beginner, had to take some notes. Useful article, thank you! Btw, what is the color (guess it is violet, but not sure), thanks again!</p> ',
            'post_id' => '9',
            'user_id' => '6',
            'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')->format('Y-m-d H:i:s'),
        ]);
    }
}
