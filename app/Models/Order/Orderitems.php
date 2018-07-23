<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu\Dishes;
use App\Models\Element\Material;

class Orderitems extends Model
{
	protected $fillable = ['dishes_id','flavour','selectspecial','amount','price','total'];
			
	public function orders()
	{
		return $this->belongsTo(orders::class);
	}
	
	public function dishes(){
    	return $this->belongsTo(Dishes::class);
    }
    
    public function materials(){
    	return $this->belongsToMany(Material::class);
    }
    
    public function takeout(){
    	return $this->materials()->wherePivot('type', 'takeout');
    }
    
    public function extra(){
    	return $this->materials()->wherePivot('type', 'extra');
    }
}
