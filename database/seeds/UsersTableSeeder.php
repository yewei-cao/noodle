<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\Access\User\User;
use App\Models\Access\User\Permission;
use App\Models\Access\User\Role;

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
    	
    	$user = User::create(array(
    			'email' => 'yeweicao@gmail.com',
    			'password' => Hash::make('laravel'),
    			'name' => 'Administrator',
    	));
    	
//     	$user = new User();
//     	$user->email = "yeweicao@gmail.com";
//     	$user->password = Hash::make('laravel');
//     	$user->name   = 'Administrator';
//     	$user->created_at   = Carbon::now();
//     	$user->updated_at   = Carbon::now();
//     	$user->save();
    	
    	
    	$permission = new Permission();
    	
    	$permission->name = "manage_backend";
    	$permission->label = "manage backend";
    	$permission->created_at   = Carbon::now();
    	$permission->updated_at   = Carbon::now();
    	$permission->save();
    	
    	$role = new Role();
    	
    	$role->name="manager";
    	$role->label = "manage backend";
    	$role->created_at   = Carbon::now();
    	$role->updated_at   = Carbon::now();
    	$role->save();
    	
    	$role->givePermissionTo($permission);
    	
    	$user->assignRole($role);
    	
    }
}
