<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu\Dishes;

class Orders extends Model
{
    protected $fillable = ['ordernumber','total','totaldue','status','name','email','phonenumber','paymentflag','staff_id','paymentmethod_id','paymenttime','shiptime','shipmethod','useraddress_id','comment','message'];
	
    public function dishes(){
    	return $this->belongsToMany(Dishes::class) ->withPivot('amount','total'); 
    }
    
}
