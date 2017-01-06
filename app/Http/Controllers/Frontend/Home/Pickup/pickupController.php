<?php

namespace App\Http\Controllers\Frontend\Home\Pickup;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Home\PickupDetailRequest;
use Carbon\Carbon;
use Illuminate\Http\Response;
use App\Http\Requests\Frontend\Home\PickupTimeRequest;
use Form;


class pickupController extends Controller
{
	
	public function index(Request $request){
// 		$request->session()->forget('user_details');
		
		if(!$request->session()->has('user_details')){
			return view('frontend.home.pickup.index');
		}
		
		$pickup = $request->session()->get('user_details');

		return view('frontend.home.pickup.edit')->withPickup($pickup);
		
	}
	
	public function ordertime(Request $request){
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
	
	public function saveordertime(Request $request){
		if(!$request->input('ordertime')){
			sweetalert_message()->n_overlay('Please choose a valid time','Invalid Time');
			return redirect()->route('home.pick.details');
		}else{
			$request->session()->put('ordertime', $request->input('ordertime'));
			if($request->session()->has('ordertime')){
				return redirect('home/menu/noodles');
// 				return redirect()->route('home.menu.index');
			}
		}
	}
	
	/*
	 * save pick up detail in session
	 * 
	 */
	
	public function pickup_details(PickupDetailRequest $request){
// 		return "test";
		$datas = $request->all();
		
		$request->session()->put('user_details', $datas);
		
		if($request->session()->has('user_details')){
			$request->session()->put('ordertype', 'pickup');
			
			if($request->session()->has('ordertype')){
				return redirect()->route('home.ordertime');
			}
			return redirect()->route('home.pickup.info');
			
		}
		return redirect()->route('home.pickup.info');
		
	}
    
}
