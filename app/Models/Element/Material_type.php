<?php

namespace App\Models\Element;

use Illuminate\Database\Eloquent\Model;

class Material_type extends Model
{
	protected $fillable = ['name','description'];
	
	
	public function material(){
		return $this->hasMany(Material::class);
	}
    
}
