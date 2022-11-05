<?php

use Illuminate\Database\Seeder;

class PriotityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // iteem statuses
        DB::table('priorities')->insert([
            'id' => '89202f5b-a1d1-43f1-b9d4-b64b13389134',
            'name' => 'Low',
            'description' => 'Low',
            'label' => 'label-primary',
            'user_id' => 1,
        ]);

        DB::table('priorities')->insert([
            'id' => '383aaf7-a45b-4931-918f-fab3daa8a97a',
            'name' => 'Medium',
            'description' => 'Medium',
            'label' => 'label-warning',
            'user_id' => 1,
        ]);

        DB::table('priorities')->insert([
            'id' => '276b2772-7230-4f83-bbd7-ec45e3da2ae4',
            'name' => 'High',
            'description' => 'High',
            'label' => 'label-danger',
            'user_id' => 1,
        ]);
    }
}
