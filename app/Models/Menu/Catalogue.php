<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;
use App\Models\Access\User\User;
use App\Models\Menu\Type;

class Catalogue extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
// 	protected $table = 'catalogues';
	
	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
// 	protected $guarded = ['id'];
	
	protected $fillable = ['user_id','type_id','name','description','ranking'];
    
	public function user(){
		return $this->belongsTo(User::class,'user_id');
	}
	
	public function type(){
		return $this->belongsTo(Type::class,'type_id');
	}
	
	public function dishes(){
		return $this->belongsToMany(Dishes::class);
	}
	
	public function addCatalogues(User $user,Catalogue $catalogue){
		$user->catalogues()->save($catalogue);
	}
	
// 	public function user_type(){
			
// 		return $this->belongsTo(User::class,'user_id',Type::class,'type_id');
// 	}
	
}
