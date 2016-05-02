<?php

use Illuminate\Database\Seeder;

<<<<<<< HEAD
use Carbon\Carbon;
use App\Models\Access\User\User;
use App\Models\Access\User\Permission;
use App\Models\Access\User\Role;
=======
use App\Models\Access\User\User;
>>>>>>> fb249198e8af973b9182767ce4a4d02a6f479aa8

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
    	
<<<<<<< HEAD
    	$user = User::create(array(
    			'email' => 'yeweicao@gmail.com',
=======
    	User::create(array(
    			'email' => 'sam.yeweicao@gmail.com',
>>>>>>> fb249198e8af973b9182767ce4a4d02a6f479aa8
    			'password' => Hash::make('laravel'),
    			'name' => 'Administrator',
    	));
    	
<<<<<<< HEAD
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
=======
>>>>>>> fb249198e8af973b9182767ce4a4d02a6f479aa8
    	
    }
}
