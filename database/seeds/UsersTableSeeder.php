<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Adrian Hajdin',
                'bio' => 'Passionate JavaScript Developer 💻',
            ],
            [
                'name' => 'Brandon Wozniewicz',
                'bio' => 'Air traffic controller, instructor, writer, software engineer, and minimalist on a mission to inspire more people to ask why. @BrandonWoz',
            ],
            [
                'name' => 'Zell Liew',
                'bio' => 'Frontend consultant; teaching frontend to self-taught devs at zellwk.com. Currently attempting to demystify Javascript at https://learnjavascript.today',
            ],
            [
                'name' => 'Srishti Gupta',
                'bio' => 'Software Developer . Pedant . Preceptor . Senior Course Developer (Full-Stack Web Development) @ upGrad',
            ],
            [
                'name' => 'Samuel Omole',
                'bio' => 'Software developer, consultant, tutor, ❤🎸',
            ],
            //6
            [
                'name' => 'Janeth Ledezma',
                'bio' => 'Janeth is a Developer Advocate for Standard Library.',
            ],
            [
                'name' => 'Nick Gard',
                'bio' => 'Web Developer, Oregonian, husband.',
            ],
            [
                'name' => 'Florin Pop',
                'bio' => 'JavaScript enthusiast 🙌, Front-end developer 💻 & Blogger at https://florin-pop.com/blog/',
            ],


        ];


        foreach ($users as $index => $user) :

            $email = explode(" ", $user['name'])[0] . "@" . explode(" ", $user['name'])[1] . ".com";
            $index = $index + 1;

            DB::table('users')->insert([
                'id' => $index,
                'name' => $user['name'],
                'email' => $email,
                'bio' => $user['bio'],
                'avatar' => "seeds/avatars/" . $index . ".jpeg",
                'password' => bcrypt('password'),
            ]);

        endforeach;


    }
}
