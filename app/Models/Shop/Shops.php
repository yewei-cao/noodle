<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
	protected $fillable = ['title','meta','cash','credit','poli','dayoff','starttime','closetime'];
	
}
