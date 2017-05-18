<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Orders;
use Carbon\Carbon;

class Coupons extends Model
{
	protected $fillable = ['code','title','value','photo_path','email','used','used_time','expired_time'];
	
	public function order(){
		return $this->belongsTo(Orders::class);
	}
	
	public function expiretime(){
		return Carbon::parse($this->expired_time)->format('Y-m-d');
	}
}
