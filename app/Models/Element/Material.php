<?php

namespace App\Models\Element;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu\Dishes;

class Material extends Model
{
	protected $fillable = ['material_type_id','name','description','photo_name','photo_path','photo_thumbnail_path','price','valid'];
	
	public function scopeValid($query){
		$query->where('valid','=','1');
	}
	
	public function user(){
		return $this->belongsTo(User::class,'user_id');
	}
	
	public function type(){
		return $this->belongsTo(Material_type::class,'material_type_id');
	}
	
	public function mgroup(){
		return $this->belongsToMany(Mgroup::class);
	}
	
	public function dishes(){
		return $this->belongsToMany(Dishes::class);
	}
	
}
