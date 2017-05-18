<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Access\User\Users;
use Carbon\Carbon;
use App\Models\Shop\Coupons;

class Orders extends Model
{
    protected $fillable = ['ordernumber','total','totaldue','status','ordertype','name','email','phonenumber','token','paymentflag','staff_id','paymentmethod_id','paymenttime','shiptime','shipmethod','userip','comment','message'];
	
    public function coupon(){
    	return $this->hasOne(Coupons::class);
    }
    
    public function address(){
    	return $this->hasOne(Address::class,'orders_id');
    }
    
    public function attachaddress($address){
    	$this->address()->attach($address);
    }
    
    public function users(){
    	 return $this->belongsToMany(Users::class);
    }
    
    public function orderitems(){
    	return $this->hasMany(Orderitems::class);
    }
    
    public function createtime(){
    	return Carbon::parse($this->created_at)->format('Y-m-d H:i');
    }
    
    public function paymenttime(){
    	return Carbon::parse($this->paymenttime)->format('Y-m-d H:i');
    }
    
    public function shiptime(){
    	return Carbon::parse($this->shiptime)->format('Y-m-d H:i');
    }
    
    public function shiptimeformat(){
    	return Carbon::parse($this->shiptime)->format('l h:i A');
    }
    
    public function customernumber(){
    	return substr($this->ordernumber, -4);
    }
    
    
    public function status(){
    	switch ($this->status){
    		case $this->status ==1:
    			return '<span id="status-'. $this->id.'" class="label label-sm label-warning">created<span>';
    			break;
    		case $this->status ==2:
    			return '<span id="status-'. $this->id.'" class="label label-sm label-info ">printed<span>';
    			break;
    		case $this->status ==3:
    			return '<span id="status-'. $this->id.'" class="label label-sm label-inverse">cooked<span>';
    			break;
    		case $this->status ==4:
    			return '<span id="status-'. $this->id.'" class="label label-sm label-success">finished<span>';
    			break;
    		case $this->status >=5:
    			return '<span id="status-'. $this->id.'" class="">Cancel<span>';
    			break;
    		default:
    			return '<span id="status-'. $this->id.'" class="">Cancel<span>';
    			break;
    	}
    }
    
    public function orderstatus(){
    	switch ($this->status){
    		case $this->status ==1:
    			return 'created';
    			break;
    		case $this->status ==2:
    			return 'printed';
    			break;
    		case $this->status ==3:
    			return 'cooked';
    			break;
    		case $this->status ==4:
    			return 'finished';
    			break;
    		case $this->status >=5:
    			return 'Cancel';
    			break;
    		default:
    			return 'Cancel';
    			break;
    	}
    }
    
    public function payment(){
    	switch ($this->paymentflag){
    		case $this->paymentflag ==1:
    			return "unpaid";
    			break;
    		case $this->paymentflag ==2:
    			return "paid";
    			break;
    		case $this->paymentflag >=3:
    			return "refunded";
    			break;
   		}
    }
    
    public function paymentmethod(){
    	switch($this->paymentmethod_id){
    		case $this->paymentmethod_id ==1 :
    			return "Cash";
    			break;
    		case $this->paymentmethod_id ==2 :
    			return "Poli";
    			break;
    		case $this->paymentmethod_id ==3 :
    			return "Creidt Card";
    			break;
    		case $this->paymentmethod_id >=4 :
    			return "Others";
    			break;
    		default :
    			return "Others";
    			break;
    	}
    }
    
}
