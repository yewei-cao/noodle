<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Blacklists extends Model
{
	protected $fillable = ['ip','reason'];
	
	/**
	 * Get all blacklist as collection.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAllBlacklists()
	{
		return Blacklists::all();
	}
	
	/**
	 * check the ip is in black list or not.
	 *
	 * @param string $ip
	 * @return boolean
	 */
	public static function checkip($ip){
		
		foreach (Blacklists::all() as $blacklist){
			if($blacklist->ip == $ip){
				return true;
			}
		}
		return false;
	
	}
}
