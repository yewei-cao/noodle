<?php

namespace App\Http\Controllers\Frontend\Home\Ordertime;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ordertimeController extends Controller
{
	private $starttime=11;
	private $closetime=21;
	
	private $dayoff = Carbon::MONDAY; //maybe a group, so set it up by group
	
	/*
	 *
	 *
	 */
	public function details(Request $request){
// 		$request->session()->forget('ordertype');
		
// 		dd($request->session());
		if(!$request->session()->has('ordertype')){
			return redirect()->back();
		}
	
		$dt = Carbon::now();//add hour for the test  ->addMinutes(7)
	
		$minutes=0;
	
		$nowtimestamp = Carbon::now()->timestamp;
	
		$time[""]="--- Select Time ---";
	
		if($dt->hour <$this->starttime){
				
			$minutes = 15;
				
			$ordertime = Carbon::create($dt->year, $dt->month, $dt->day, $this->starttime, $minutes);
				
			$time[$ordertime->timestamp] = $ordertime->format('h:i A');
				
			$loop = ($this->closetime-$this->starttime-1)*4 +(60-$minutes)/15;
			for($i=1;$i<=$loop;$i++){
				$time[$ordertime->copy()->addMinutes($i*15)->timestamp] = $ordertime->copy()->addMinutes($i*15)->format('h:i A');
					
			}
				
			for($i=0;$i<=10;$i++){
				if($dt->copy()->addDays($i)->dayOfWeek != $this->dayoff){
					$date[$dt->copy()->addDays($i)->timestamp]= $dt->copy()->addDays($i)->formatLocalized('%A %d %B %Y');
				}
			}
				
		}elseif (($this->starttime <= $dt->hour)&&($dt->hour < $this->closetime)){
				
			switch ($dt->minute)	{
				case $dt->minute< 15:
					$minutes = 30;
					break;
				case $dt->minute<30:
					$minutes = 45;
					break;
				case $dt->minute<45:
					$minutes = 00;
					$dt->hour++;
					break;
				case $dt->minute<60:
					$minutes = 15;
					$dt->hour++;
					break;
			}
				
			$ordertime = Carbon::create($dt->year, $dt->month, $dt->day, $dt->hour, $minutes);
				
			$time[$ordertime->timestamp] = $ordertime->format('h:i A');
				
			$loop = ($this->closetime-$dt->hour-1)*4 +(60-$minutes)/15;
			for($i=1;$i<=$loop;$i++){
				$time[$ordertime->copy()->addMinutes($i*15)->timestamp] = $ordertime->copy()->addMinutes($i*15)->format('h:i A');
					
			}
				
			for($i=0;$i<=10;$i++){
				if($dt->copy()->addDays($i)->dayOfWeek != $this->dayoff){
					$date[$dt->copy()->addDays($i)->timestamp]= $dt->copy()->addDays($i)->formatLocalized('%A %d %B %Y');
				}
			}
				
		}else{
				
			$minutes = 15;
	
			$ordertime = Carbon::create($dt->year, $dt->month, $dt->day+1, $this->starttime, $minutes);
				
			$time[$ordertime->timestamp] = $ordertime->format('h:i A');
				
			$loop = ($this->closetime-$this->starttime-1)*4 +(60-$minutes)/15;
			for($i=1;$i<=$loop;$i++){
				$time[$ordertime->copy()->addMinutes($i*15)->timestamp] = $ordertime->copy()->addMinutes($i*15)->format('h:i A');
					
			}
	
			for($i=0;$i<=10;$i++){
				if($dt->copy()->addDays($i+1)->dayOfWeek != $this->dayoff){
					$date[$dt->copy()->addDays($i)->timestamp]= $dt->copy()->addDays($i+1)->formatLocalized('%A %d %B %Y');
				}
			}
		}
	
		// 		dd( Carbon::createFromTimestamp(1450436210)->toDateTimeString());
		return view('frontend.home.ordertime',compact('date','time','nowtimestamp'));
	}
	
	public function gettime(Request $request){
		// Getting all post data
		if($request->ajax()) {
			$date = $request->input('date');
				
			$dt = Carbon::createFromTimestamp($date);
	
			$minutes = 15;
				
			$ordertime = Carbon::create($dt->year, $dt->month, $dt->day, $this->starttime, $minutes);
				
			$time[0][0] = $ordertime->timestamp;
			$time[0][1] = $ordertime->toDateTimeString();
				
			$loop = ($this->closetime-$this->starttime-1)*4 +(60-$minutes)/15;
			for($i=1;$i<=$loop;$i++){
				$time[$i][0] = $ordertime->copy()->addMinutes($i*15)->timestamp;
				$time[$i][1] = $ordertime->copy()->addMinutes($i*15)->toDateTimeString();
// 				$time[$ordertime->copy()->addMinutes($i*15)->timestamp] = $ordertime->copy()->addMinutes($i*15)->toDateTimeString();
			}
				
			return $time;
// 			return response()->json(['date' => $time]);
		}
			
	}
	
	/*
	 * save date and time of pick up detail in session
	 */
	
	public function save(Request $request){
		if(!$request->input('ordertime')){
			sweetalert_message()->n_overlay('Please choose a valid time','Invalid Time');
			return redirect()->route('home.pick.details');
		}else{
			$request->session()->put('ordertime', $request->input('ordertime'));
			if($request->session()->has('ordertime')){
				return redirect()->route('home.menu.index');
			}
		}
			
	}
	
	/*
	 * save as soon as possible time tin session
	 */
	public function save_asap(Request $request){
	
		if($request->ajax()){
			$request->session()->put('ordertime', $request->input('ordertime'));
	
			if($request->session()->has('ordertime')){
				return response()->json([
						'message'=>'success'
				]);
			}else{
				return response()->json([
						'error' => false,
						'message' => 'Valid Order Time'
				]);
			}
		}
	
	}
	
}
