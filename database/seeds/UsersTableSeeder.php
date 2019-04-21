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
        	'name' => 'Anna Smith',
        	'gender' => 'female',
            'slug' => 'anna-smith',
            'pic' => 'girl.png',
            'email' => 'anna@test.com',
            'email_verified_at' => NULL,
            'remember_token' => NULL,
            'password' => Hash::make('annaanna'),
            'role' => 'admin',
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
        	'password' => Hash::make('emmaemma'),
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
