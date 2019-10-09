<?php

use Illuminate\Database\Seeder;

class AdminPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_pemissions')->insert([
            'admin_id' => '1',
            'permission_id' => '1',
        ]);

        DB::table('admin_pemissions')->insert([
            'admin_id' => '2',
            'permission_id' => '1',
        ]);
        
    }
}
