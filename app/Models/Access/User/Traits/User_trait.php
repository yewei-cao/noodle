<?php
namespace App\Models\Access\User\Traits;
use App\Models\Access\User\Role;
use App\Models\Menu\Type;
use App\Models\Menu\Catalogue;
use App\Models\Material\Material;
use App\Models\Order\orders;

trait User_trait {
	
	
	public function getemail(){
		return $this->email;
	}
	/*
	 * Roles
	 */
	public function roles(){
		return $this->belongsToMany(Role::class);
	}
	
	public function assignRole(Role $role){
// 		return $this->roles()->save(Role::whereName($role)->firstOrFail());
		return $this->roles()->save($role);
	}
	
	public function hasRole($role){// $role is a string here
		if(is_string($role)){
			return $this->roles->contains('name',$role);
		}
		return !! $role->intersect($this->roles)->count();
	}
	
	
	/**
	 * Check if user has a permission by its name or id.
	 *
	 * @param  string $nameOrId Permission name or id.
	 * @return bool
	 */
	public function allow($nameOrId)
	{
		foreach ($this->roles as $role) {
			
			// Validate against the Permission table
			foreach ($role->permissions as $perm) {
	
				//First check to see if it's an ID
				if (is_numeric($nameOrId)) {
					if ($perm->id == $nameOrId) {
						return true;
					}
				}
	
				//Otherwise check by name
				if ($perm->name == $nameOrId) {
					return true;
				}
			}
		}

	
		return false;
	}
		
// 	public function catalogues(){
// 		return $this->hasMany(Type::class,'type_id',Catalogue::class,'id');
// 	}
	
	/*
	 * For dishes
	 */
	
	public function types(){
		return $this->hasMany(Type::class);
	}
	
	public function addType(Type $type){
		$this->types()->save($type);
	}
	
	public function catalogues(){
		return $this->hasMany(Catalogue::class);
	}
	
	public function orders(){
		return $this->belongsToMany(Orders::class);
	}
	
	public function hasorder($orderid){
		foreach ($this->orders as $order) {
// 			if (is_numeric($orderid)) {
				if ($order->id == $orderid) {
					return true;
// 				}
			}
		}
	}
	
	public function descorders(){
// 		return $this->orders()->();
		return $this->orders()->orderBy('orders_id', 'DESC')
		->where('created_at','>=', \Carbon\Carbon::today()->subDays(7) )->get();
// 		->whereBetween('created_at',[\Carbon\Carbon::today()->subDays(7), \Carbon\Carbon::today()] )->get();
// 		return $this->orders->orderBy('orders_id', 'DESC');
	}
	
	public function lastorders(){
		return $this->orders()->orderBy('orders_id', 'DESC')
		->where('created_at','<=', \Carbon\Carbon::today()->subDays(7) )->get();
	}
	
	public function attachorder($order){
		$this->orders()->attach($order);
	}
	
	/**
     * Add a user and type to catalogue.
     *
     * @param  int  $id, Catalogue $catalogue
     * @return null
     */
	public function addCatalogues(Type $type,Catalogue $catalogue){
		$catalogue->type_id = $type_id;
		$this->catalogues()->save($catalogue);
	}
	
	
	public function materials(){
		return $this->hasMany(Material::class);
	}
	
}


