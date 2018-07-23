<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;
use App\Models\Element\Material;
use App\Models\Element\Mgroup;
use App\Models\Order\Orderitems;

class Dishes extends Model
{
	protected $fillable = ['mgroup_id','name','price','number','ranking','description','consumptionpoint','photo_name','photo_path','photo_thumbnail_path','valid'];
	
	public function catalogue(){
		return $this->belongsToMany(Catalogue::class);
	}
	
	public function mgroup(){
		return $this->belongsTo(Mgroup::class,'mgroup_id');
	}
	
// 	public function order(){
// 		return $this->belongsToMany(Dishes::class) ->withPivot('amount','total');
// 	}
	
	public function materials(){
		return $this->belongsToMany(Material::class);
	}
	
	public function orderitems(){
		return $this->hasMany(Orderitems::class);
	}
	
	/**
 * Attach one material associated with a dish 
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


/**
 * Attach one  catalogue  associated with a dish
 *
 * @param $material
 */
public function attachCatalogue($catalogue) {
	if( is_object($catalogue))
		$catalogue = $catalogue->getKey();

	if( is_array($catalogue))
		$catalogue = $catalogue['id'];

	$this->catalogue()->attach($catalogue);
}


/**
 * Detach one catalogue not associated with a dish
 *
 * @param $material
 */
public function detachCatalogue($catalogue) {
	if( is_object($catalogue))
		$catalogue = $catalogue->getKey();

	if( is_array($catalogue))
		$catalogue = $catalogue['id'];

	$this->catalogue()->detach($catalogue);
}

/**
 * Detach other materials not associated with a dish
 *
 * @param $permissions
 */
public function detachCatalogues($catalogues) {
	foreach ($catalogues as $perm) {
		$this->detachCatalogue($perm);
	}
}
	
	
}
