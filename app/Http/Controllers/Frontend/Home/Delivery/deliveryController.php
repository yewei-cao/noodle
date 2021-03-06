<?php

namespace App\Http\Controllers\Frontend\Home\Delivery;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cookie;
use App\Http\Controllers\Controller;
use App\Models\Shop\Shops;

class deliveryController extends Controller
{
	public function __construct(){
		$this->shop = Shops::first();
	}
	
    /**
     * Display a listing of the resource.
     *delivery_details
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->cookie('user_details_cookie')){
			return view('frontend.home.delivery.index')
					->withShop($this->shop);
		}
		
		$delivery = $request->cookie('user_details_cookie');

		return view('frontend.home.delivery.edit')->withdelivery($delivery)
				->withShop($this->shop);
    }
    
    /*
     * save pick up detail in session
     *
     */
    
    public function delivery_details(Request $request){
    	$datas = $request->all();
    
    	Cookie::queue('user_details_cookie', $datas, 45000);
    	
    	$request->session()->put('user_details', $datas);
    
    	if($request->session()->has('user_details')){
    		return redirect()->route('home.delivery.confirm');
    	}else{
    		return redirect()->route('home.delivery.info');
    	}
    
    }
    
    /**
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm(Request $request){
    	if(!$request->session()->has('user_details')){
    		return redirect()->route('home.delivery.info');
    	}
    	
    	$user_details = $request->session()->get('user_details');
    	$address =  $user_details['address'].' '.$user_details['suburb'].' '.$user_details['city'];
    	$deliveryfee = $this->diliveryfee($address);
    	
    	$user_details += [
    			'deliveryfee' => $deliveryfee
    	];
    	
    	$request->session()->put('user_details', $user_details);
    	$request->session()->put('userdelvieryfee', $deliveryfee);
    	
    	if($deliveryfee && $request->session()->has('user_details')){
    		
    		return view('frontend.home.delivery.confirm')
    		->withAddress($address)
    		->withDeliveryfee($deliveryfee);
    	}else{
    		sweetalert_message()->n_overlay('Your address is over our delivery distance.','Invalid Address');
    		return redirect()->route('home.delivery.info');
    	}
    	
    }
    
    public function address_confirm(Request $request){
    	if($request->session()->has('user_details')){
    		
    		$request->session()->put('ordertype', 'delivery');
    		
    		if($request->session()->has('ordertype')){
    			return redirect()->route('home.ordertime');
    		}
    		return redirect()->route('home.delivery.confirm');
    	}
    	return redirect()->route('home.delivery.info');
    }
    
    
    public function diliveryfee($address){
    	$origin= urlencode($this->shop->address);
    	$destination= urlencode($address);
    	$url = "https://maps.googleapis.com/maps/api/directions/json?origin=".$origin."&destination=".$destination."&key=".$this->shop->googleapi;
    	$json = json_decode(file_get_contents($url), true);
    	
    	//return distance/1000 * distance charge fee.
    	if($json['routes'][0]['legs'][0]['distance']['value']<3000){
    		return ceil($json['routes'][0]['legs'][0]['distance']['value']/1000)*$this->shop->distancefee;
    	}
    	
//     	return ceil($json['routes'][0]['legs'][0]['distance']['value']/1000)*$this->shop->distancefee;
    	//distance less than 5km or 20km
//     	if($json['routes'][0]['legs'][0]['distance']['value']<2200){
//     		return $this->shop->distancefee;
//     	}if($json['routes'][0]['legs'][0]['distance']['value']<3000){
//     		return $this->shop->distancefee+$this->shop->maxfree;
//     	}
    	elseif ($json['routes'][0]['legs'][0]['distance']['value']<10000){
//     		return ceil($json['routes'][0]['legs'][0]['distance']['value']/1000)+$this->shop->maxfree;
    		return ceil($json['routes'][0]['legs'][0]['distance']['value']/1000)*$this->shop->maxfree;
    	}else{
    		return false;
    	}
    }

}
