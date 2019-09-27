<?php

use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Admin',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Personal',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_types')->insert([
            'id' => '07c99d10-8e09-4861-83df-fdd3700d7e48',
            'name' => 'Business',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
