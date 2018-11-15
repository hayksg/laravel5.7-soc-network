<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('friendships')->truncate();

        $this->call(UsersTableSeeder::class);
        $this->call(FriendshipsTableSeeder::class);
    }
}
