<?php

use Illuminate\Database\Seeder;

class FriendshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friendships')->insert([
        	'requester' => 1,
        	'user_requested' => 2,
            'status' => true,
        	'created_at' => date('Y-m-d H:m:s'),
        	'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('friendships')->insert([
        	'requester' => 3,
        	'user_requested' => 2,
            'status' => true,
        	'created_at' => date('Y-m-d H:m:s'),
        	'updated_at' => date('Y-m-d H:m:s')
        ]);
    }
}
