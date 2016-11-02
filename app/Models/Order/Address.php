<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	protected $fillable = ['address','suburb','city'];
			
	public function orders()
	{
		return $this->belongsTo(orders::class);
	}
}
