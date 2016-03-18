<?php

use Illuminate\Database\Seeder;

use App\Models\Access\User\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//     	DB::table('users')->delete();
    	
    	User::create(array(
    			'email' => 'sam.yeweicao@gmail.com',
    			'password' => Hash::make('laravel'),
    			'name' => 'Administrator',
    	));
    	
    	
    }
}
