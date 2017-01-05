<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;
use App\Models\Access\User\User;
use App\Models\Menu\Catalogue;

class Type extends Model
{
	protected $fillable = ['name','description','ranking']; 
    
	public function owner(){
		return $this->belongsTo(User::class,'users_id');
	}
	
	public function catalogues(){
		return $this->hasMany(Catalogue::class);
	}

// 	public function users(){
// 		return $this->hasMany(User::class,'user_id',Catalogue::class,'id');
// 	}
    
	public function addCatalogues(User $user,Catalogue $catalogue){
		$user->catalogues()->save($catalogue);
	}
	
    
	
}
