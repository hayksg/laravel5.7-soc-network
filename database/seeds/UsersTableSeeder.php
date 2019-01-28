<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        	'name' => 'John Smith',
        	'gender' => 'male',
            'slug' => 'john-smith',
            'pic' => 'boy.png',
            'email' => 'john@test.com',
            'email_verified_at' => NULL,
            'remember_token' => NULL,
        	'password' => '$2y$10$4ftOStkjfQRpzeg8IauSR.DAybxsX/tuJNN68Kz2jSNFjz9b5S7Pe',
        	'created_at' => date('Y-m-d H:m:s'),
        	'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('profiles')->insert([
        	'user_id' => 1
        ]);

        DB::table('users')->insert([
        	'name' => 'Anna Smith',
        	'gender' => 'female',
            'slug' => 'anna-smith',
            'pic' => 'girl.png',
            'email' => 'anna@test.com',
            'email_verified_at' => NULL,
            'remember_token' => NULL,
        	'password' => '$2y$10$tlqa/sJNh9NmrxSkhZvxHuveppzBCl6WXymJbJcY7Q1uFC5MLZojC',
        	'created_at' => date('Y-m-d H:m:s'),
        	'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('profiles')->insert([
        	'user_id' => 2
        ]);

        DB::table('users')->insert([
        	'name' => 'Emma Hall',
        	'gender' => 'female',
            'slug' => 'emma-hall',
            'pic' => 'girl.png',
            'email' => 'emma@test.com',
            'email_verified_at' => NULL,
            'remember_token' => NULL,
        	'password' => '$2y$10$d3kR.fCAPMwKdRbzj8Zg/OFCOZTIygWar21sBnbQB65XVd6ADQxFG',
        	'created_at' => date('Y-m-d H:m:s'),
        	'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('profiles')->insert([
        	'user_id' => 3
        ]);

        DB::table('users')->insert([
        	'name' => 'UserWithVeryLongFirstNameAndLastName',
        	'gender' => 'male',
            'slug' => 'UserWithVeryLongFirstNameAndLastName',
            'pic' => 'boy.png',
            'email' => 'UserWithVeryLongFirstNameAndLastName@test.com',
            'email_verified_at' => NULL,
            'remember_token' => NULL,
        	'password' => Hash::make('longname'),
        	'created_at' => date('Y-m-d H:m:s'),
        	'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('profiles')->insert([
        	'user_id' => 4
        ]);

        DB::table('users')->insert([
        	'name' => 'UserWithVeryLongFirstName UserWithVeryLongLastName',
        	'gender' => 'male',
            'slug' => str_slug('UserWithVeryLongFirstName UserWithVeryLongLastName', '-'),
            'pic' => 'boy.png',
            'email' => 'foo@test.com',
            'email_verified_at' => NULL,
            'remember_token' => NULL,
        	'password' => Hash::make('firstlast'),
        	'created_at' => date('Y-m-d H:m:s'),
        	'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('profiles')->insert([
        	'user_id' => 5
        ]);
    }
}
