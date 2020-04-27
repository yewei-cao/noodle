<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
	protected $fillable = ['title','address','phone','distancefee','maxfree','freedelivery','googleapi','meta','cash','credit','poli','poliapi','dayoff','starttime','closetime','coupon','email_coupon','coupon_value','coupon_condition','coupon_maxamount',
				'coupon_maxvalue',
				'openhours',
				'showtext',
				'popup',
				'popuptext',
				'printer'];
	
	public function workday(){
		$days = explode(",",$this->dayoff);
		
		return $days;
	}
}
