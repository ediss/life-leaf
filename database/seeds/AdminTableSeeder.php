<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Edis Dev',
            'email' => 'dev@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        
        DB::table('admins')->insert([
            'name' => 'Maja Vučković',
            'email' => 'maja.admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        DB::table('admins')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
