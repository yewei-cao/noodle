<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Menu\Dishes;
use App\Models\Menu\Catalogue;
use Cart;
use App\Models\Shop\Shops;
use App\Models\Menu\Type;

class menuController extends Controller
{

	/*
	 * use ordertype middleware
	 */
	public function __construct(){
		$this->middleware('ordertypeMiddleware');
		$this->shop = Shops::first();
	}
	
    /**
     * Display the menu, includes all catalogues.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//     	$request->session()->flush();
    	
    	/* if session expired, then route to home page. */
//     	if((!$request->session()->has('ordertype'))||(!$request->session()->has('ordertime'))){
//     		sweetalert_message()->n_overlay(trans("menus.session.expire"),'Session Expire');
//     		return redirect()->route('home');
//     	}

//     	dd($request->session()->get('ordertime'));
//     	$dish = Dishes::where('number','9')->first();
//     	dd($dish->name);

    	$order_route=[
    			'prev'=>'',
    			'next'=>route('home.payment.paymentmethod')
    	];
    	
    	$catalogues = Catalogue::orderBy('ranking', 'asc')->get();
    	$active = [
    			'menu'=>'active',
    			'noodles'=>'',
    			'rice'=>'',
    			'snack&drinks'=>'',
    			'soups'=>'',
    			'chips'=>'',
    			'payment'=>''];
    	
//     	dd($catalogues);
    	
    	
    	$cart = Cart::all();
    	
    	$deliveryfee = $this->deliveryfee($request);
    	
    	$totalprice = Cart::total() + $deliveryfee;
    	$totalnumber = Cart::count();
    	return view('frontend.home.menu_content',compact('catalogues','cart','totalprice','totalnumber'))
    	->withOrderroute($order_route)
    	->withDeliveryfee($deliveryfee)
    	->withActive($active);
    }
    
    public function types($type,Request $request){
    	    	
    	$catalogues = Catalogue::where('name', $type)->orderBy('ranking', 'asc')->get();
    	
	    switch ($type){
			case "noodles":
				$active = [
				'menu'=>'',
				'noodles'=>'active',
				'rice'=>'',
				'snack&drinks'=>'',
				'soups'=>'',
				'chips'=>'',
				'payment'=>''];
		    	$order_route=[
		    			'prev'=>'',
		    			'next'=>'/home/menu/rice'
		    	];
				break;
			case "rice":
				$active = [
				'menu'=>'',
				'noodles'=>'',
				'rice'=>'active',
				'snack&drinks'=>'',
				'soups'=>'',
				'chips'=>'',
				'payment'=>''];
				$order_route=[
						'prev'=>'/home/menu/noodles',
						'next'=>'/home/menu/snack&drinks'
				];
				break;
			case "snack&drinks":
			 	$active = [
			 	'menu'=>'',
				'noodles'=>'',
				'rice'=>'',
				'snack&drinks'=>'active',
				'soups'=>'',
				'chips'=>'',
				'payment'=>''];
			 	$order_route=[
			 			'prev'=>'/home/menu/rice',
			 			'next'=>route('home.payment.paymentmethod')
			 	];
			  	break;
		  	case "soups":
		  		$active = [
		  		'menu'=>'',
				'noodles'=>'',
				'rice'=>'',
				'snack&drinks'=>'',
				'soups'=>'active',
				'chips'=>'',
				'payment'=>''];
		  		$order_route=[
		  				'prev'=>'/home/menu/noodles',
		  				'next'=>route('home.payment.paymentmethod')
		  		];
		  		break;
	  		case "chips":
	  			$active = [
	  			'menu'=>'',
				'noodles'=>'',
				'rice'=>'',
				'snack&drinks'=>'',
				'soups'=>'',
				'chips'=>'active',
				'payment'=>''];
	  			$order_route=[
	  					'prev'=>'/home/menu/noodles',
	  					'next'=>route('home.payment.paymentmethod')
	  			];
	  			break;
		}
    	
//     	$catalogues = Catalogue::orderBy('ranking', 'asc')->get();
    	
//     	echo url('user/profile');
    	
//     	dd($catalogues);
    	
    	
    	$cart = Cart::all();
    	
    	$deliveryfee = $this->deliveryfee($request);
    	
    	$totalprice = Cart::total() + $deliveryfee;
    	$totalnumber = Cart::count();
    	return view('frontend.home.menu_content',compact('catalogues','cart','totalprice','totalnumber'))
    	->withOrderroute($order_route)
    	->withDeliveryfee($deliveryfee)
    	->withActive($active);
    	
    }
    
    
    public function addtoorder(Request $request){
    	$this->validate($request, [
    			'id' => 'required|numeric',
    	]);
    	
    	$dish = Dishes::where('id',$request->input('id'))->first();
    	
    	Cart::addone($dish->id, $dish->name, $dish->price);
//     	return $request->input('id');
//     	return Cart::all()."Total:".Cart::total();

    	return $this->shoppingcart($request);
    	 
    	
    }
    
    public function removetoorder(Request $request){
    	$this->validate($request, [
    			'id' => 'required',
    	]);
    	
    	Cart::remove($request->input('id'));
    	
    	return $this->shoppingcart($request);
    	
    }
    
    
    protected function shoppingcart(Request $request){
    	$cart = Cart::alldetails();
    	if($cart['total'] >= $this->shop->freedelivery)
    	{
    		$user_details = $request->session()->get('user_details');
    		//storing the delivery to a constant session 
    		$user_details['deliveryfee'] = 0;
    		$request->session()->put('user_details', $user_details);
    	}else {
    		$user_details = $request->session()->get('user_details');
    		$user_details['deliveryfee'] = $request->session()->get('userdelvieryfee');
    		$request->session()->put('user_details', $user_details);
    		
    		$request->session()->get('userdelvieryfee');
    	}
    	$cart['deliveryfee'] = $this->deliveryfee($request);
    	return $cart;
    }
    
    protected function deliveryfee(Request $request){
    	$deliveryfee = 0;
    	if($request->session()->get('ordertype')=='pickup'){
    		return $deliveryfee;
    	}
    	if(!empty($request->session()->get('user_details')['deliveryfee'])){
    		$deliveryfee = $request->session()->get('user_details')['deliveryfee'];
    	}
    	return $deliveryfee;
    }

    
}
