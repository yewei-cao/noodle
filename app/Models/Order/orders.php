<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu\Dishes;

class Orders extends Model
{
    protected $fillable = ['ordernumber','total','totaldue','status','name','email','phonenumber','paymentflag','staff_id','paymentmethod_id','paymenttime','shiptime','shipmethod','useraddress_id','comment','message'];
	
    public function dishes(){
    	return $this->belongsToMany(Dishes::class)->withPivot('amount','total'); 
    }
    
    public function status(){
    	switch ($this->status){
    		case $this->status ==1:
    			return '<span class="label label-sm label-warning">created<span>';
    			break;
    		case $this->status ==2:
    			return '<span class="label label-sm label-info arrowed arrowed-righ">printed<span>';
    			break;
    		case $this->status ==3:
    			return '<span class="label label-sm label-inverse arrowed-in">cooked<span>';
    			break;
    		case $this->status ==4:
    			return '<span class="label label-sm label-success">finished<span>';
    			break;
    		case $this->status >=5:
    			return '<span class="">Cancel<span>';
    			break;
    		default:
    			return '<span class="">Cancel<span>';
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
    			return "Creidt Card";
    			break;
    		case $this->paymentmethod_id >=3 :
    			return "Others";
    			break;
    		default :
    			return "Others";
    			break;
    	}
    }
    
}
