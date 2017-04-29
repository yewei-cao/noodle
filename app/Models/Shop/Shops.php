<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
	protected $fillable = ['title','address','phone','distancefee','maxfree','freedelivery','googleapi','meta','cash','credit','poli','poliapi','dayoff','starttime','closetime'];
	
	public function workday(){
		$days = explode(",",$this->dayoff);
		
		return $days;
// 		$workdays=[];
// 		$i=0;
// 		foreach ($days as $day){
// 			switch($day){
// 				case $day =="0";
// 				$workdays[$i]='Carbon::SUNDAY';
// 				$i++;
// 				break;
// 				case $day =="1";
// 				$workdays[$i]='Carbon::MONDAY';
// 				$i++;
// 				break;
// 				case $day =="2";
// 				$workdays[$i]='Carbon::TUESDAY';
// 				$i++;
// 				break;
// 				case $day =="3";
// 				$workdays[$i]='Carbon::WEDNESDAY';
// 				$i++;
// 				break;
// 				case $day =="4";
// 				$workdays[$i]='Carbon::THURSDAY';
// 				$i++;
// 				break;
// 				case $day =="5";
// 				$workdays[$i]='Carbon::FRIDAY';
// 				$i++;
// 				break;
// 				case $day =="6";
// 				$workdays[$i]='Carbon::SATURDAY';
// 				$i++;
// 				break;
				
// 			}
// 		}
		
// 		return $workdays;
	}
}
