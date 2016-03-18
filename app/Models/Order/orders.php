<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu\Dishes;

class orders extends Model
{
    protected $fillable = ['total','totaldue','status','paymentflag','staff_id','paymentmethod_id','paymenttime','shiptime','shipmethod','useraddress_id','comment','message'];
	
    public function dishes(){
    	return $this->belongsToMany(Dishes::class) ->withPivot('amount','total'); 
    }
    
    
}
