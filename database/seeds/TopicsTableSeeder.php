<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            'id' => '1',
            'name' => 'javascript',
        ]);

        DB::table('topics')->insert([
            'id' => '2',
            'name' => 'Node.js',
        ]);

        DB::table('topics')->insert([
            'id' => '3',
            'name' => 'css tips and techniques',
        ]);
    }
}
