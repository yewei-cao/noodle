<?php

namespace App\Http\Controllers\Frontend\Home\Delivery;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class deliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *delivery_details
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->session()->has('user_details')){
			return view('frontend.home.delivery.index');
		}
		
		$delivery = $request->session()->get('user_details');

		return view('frontend.home.delivery.edit')->withdelivery($delivery);
    }
    
    /*
     * save pick up detail in session
     *
     */
    
    public function delivery_details(Request $request){
    	$datas = $request->all();
    
    	$request->session()->put('user_details', $datas);
    
    	if($request->session()->has('user_details')){
    		return redirect()->route('home.delivery.confirm');
    	}else{
    		return redirect()->route('home.delivery.info');
    	}
    
    }
    
    public function confirm(Request $request){
    	if(!$request->session()->has('user_details')){
    		return redirect()->route('home.delivery.info');
    	}
    	$user_details = $request->session()->get('user_details');
    	$address =  $user_details['address'].' '.$user_details['suburb'].' '.$user_details['city'];
    	return view('frontend.home.delivery.confirm')->withAddress($address);
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
    
    public function saveordertime(Request $request){
    	return 'saveordertime';
    }

}
