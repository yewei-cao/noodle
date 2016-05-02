<?php

namespace App\Providers;

use App\Models\Access\User\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

<<<<<<< HEAD
//         foreach ($this->getPermissions() as $permission){
//         	$gate->define($permission->name, function($user)use($permission){
//         		return $user->hasRole($permission->roles);
//         	});
//         }
=======
        foreach ($this->getPermissions() as $permission){
        	$gate->define($permission->name, function($user)use($permission){
        		return $user->hasRole($permission->roles);
        	});
        }
>>>>>>> fb249198e8af973b9182767ce4a4d02a6f479aa8
        
        
    }
    
    protected function getPermissions(){
    	return Permission::with('roles')->get();
    }
}
