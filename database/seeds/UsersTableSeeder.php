<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++) {
            App\User::create([
                'name' => $faker->firstName." ".$faker->lastName,
                'email' => $faker->unique()->email,
                'bio' => $faker->paragraph(4),
                'avatat' => "avatar".$faker->numberBetween(1,2).".jpg",
                'password'=> bcrypt($faker->name),
                'site'=>$faker->domainName
            ]);
        }
    }
}
