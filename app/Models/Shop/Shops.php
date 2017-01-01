<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
	protected $fillable = ['title','address','phone','distancelevel1','distancelevel2','freedelivery','googleapi','meta','cash','credit','poli','poliapi','dayoff','starttime','closetime'];
	
}
