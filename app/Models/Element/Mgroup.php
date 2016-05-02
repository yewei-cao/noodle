<?php

namespace App\Models\Element;

use Illuminate\Database\Eloquent\Model;

class Mgroup extends Model
{
	protected $fillable = ['name','description'];
	
	public function material(){
		return $this->belongsToMany(Material::class);
}

	public function dish(){
	return $this->hasMany(Dishes::class);
}

	/**
	 * Attach one material not associated with a group directly to a dish
	 *
	 * @param $material
	 */
	public function attachMaterial($material) {
	if( is_object($material))
		$material = $material->getKey();

	if( is_array($material))
		$material = $material['id'];

	$this->material()->attach($material);
}


	/**
	 * Detach one material not associated with a group directly to a dish
	 *
	 * @param $material
	 */
	public function detachMaterial($material) {
	if( is_object($material))
		$material = $material->getKey();

	if( is_array($material))
		$material = $material['id'];

	$this->material()->detach($material);
}

	/**
	 * Detach other materials not associated with a group directly to a dish
	 *
	 * @param $permissions
	 */
	public function detachMaterials($materials) {
	foreach ($materials as $perm) {
		$this->detachMaterial($perm);
	}
}

}
