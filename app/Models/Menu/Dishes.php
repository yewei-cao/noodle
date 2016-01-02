<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;
use App\Models\Element\Material;
use App\Models\Element\Mgroup;

class Dishes extends Model
{
	protected $fillable = ['catalogue_id','mgroup_id','name','price','description','consumptionpoint','photo_name','photo_path','photo_thumbnail_path','valid'];
	
	
	public function catalogue(){
		return $this->belongsTo(Catalogue::class,'catalogue_id');
	}
	
	
	public function mgroup(){
		return $this->belongsTo(Mgroup::class,'mgroup_id');
	}
	
	
	public function materials(){
		return $this->belongsToMany(Material::class);
	}
	
	
	/**
 * Attach one material not associated with a dish 
 *
 * @param $material
 */
public function attachMaterial($material) {
	if( is_object($material))
		$material = $material->getKey();

	if( is_array($material))
		$material = $material['id'];

	$this->materials()->attach($material);
}


/**
 * Detach one material not associated with a dish 
 *
 * @param $material
 */
public function detachMaterial($material) {
	if( is_object($material))
		$material = $material->getKey();

	if( is_array($material))
		$material = $material['id'];

	$this->materials()->detach($material);
}

/**
 * Detach other materials not associated with a dish 
 *
 * @param $permissions
 */
public function detachMaterials($materials) {
	foreach ($materials as $perm) {
		$this->detachMaterial($perm);
	}
}
	
	
}
