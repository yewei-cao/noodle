<?php

namespace App\Models\Access\User;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Access\User\Role;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    
    public function roles(){
    	return $this->belongsToMany(Role::class);
    }
    
    public function assignRole($role){
    	return $this->roles()->save(Role::whereName($role)->firstOrFail());
    }
    
    public function hasRole($role){// $role is a string here
    	if(is_string($role)){
    		return $this->roles->contains('name',$role);
    	}    	
    	return !! $role->intersect($this->roles)->count();
    }
        
    //user->hasRole('mamager');
    //user->assignRole(Role);
    //user->actAs('manager');
}