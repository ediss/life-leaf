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
        DB::table('users')->insert([
            'name' => 'Perica Peric',
            'email' => 'pera@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Jana Cvetic',
            'email' => 'jana@gmail.com',
            'password' => bcrypt('12345678'),
        ]);


        DB::table('users')->insert([
            'name' => 'Mika Mikic',
            'email' => 'mika@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
