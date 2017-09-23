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
use Cookie;
use App\Models\Shop\Shops;


class pickupController extends Controller
{
	public function __construct(){
		$this->shop = Shops::first();
	}
	
	public function index(Request $request){
// 		$request->session()->forget('user_details');
		
		if(!$request->cookie('user_details_cookie')){
			return view('frontend.home.pickup.index')
					->withShop($this->shop);
		}
		
// 		if($request->cookie('user_details_cookie')){
		$pickup = $request->cookie('user_details_cookie');
// 		}else{
// 			$pickup = $request->session()->get('user_details');
// 		}
		
		return view('frontend.home.pickup.edit')->withPickup($pickup)
				->withShop($this->shop);
		
	}
	
	
	/*
	 * save date and time of pick up detail in session
	 */
	
	public function saveordertime(Request $request){
// 		return  'order time';
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
		
		Cookie::queue('user_details_cookie', $datas, 4500);
		
// 		Cookie::forever('user_details_cookie', $datas['email']);
		
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
