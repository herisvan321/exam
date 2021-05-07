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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert(
        	[
        		'name' => 'Admin',
        	    'email' => 'herisvan321@gmail.com',
        	    'password' => Hash::make('12345678')
        	]
        );
    }
}
