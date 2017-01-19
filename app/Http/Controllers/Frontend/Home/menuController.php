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
use App\Models\Element\Material;
use App\Models\Element\Material_type;
use Illuminate\Support\Facades\Redirect;

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
    
    public function dish($dish,Request $request){
//     	$dish = Dishes::findOrFail($dish);
    	$dish = Dishes::where('number', $dish)->first();
    	$materials = [];
    	$i = 0;
    	foreach ($dish->mgroup->material as $material){
    		$materials[$i]['id']=$material->id;
    		$materials[$i]['name']=$material->name;
    		$i++;
    	}
    	foreach ($dish->materials as $material){
    		$materials[$i]['id']=$material->id;
    		$materials[$i]['name']=$material->name;
    		$i++;
    	}
    	
    	$veges = Material_type::where('name', 'Veges')->first();
    	$meat = Material_type::where('name', 'Meat')->first();
    	
    	$order_route=[
    			'prev'=>'',
    			'next'=>route('home.payment.paymentmethod')
    	];
    	$active = [
    			'menu'=>'active',
    			'noodles'=>'',
    			'rice'=>'',
    			'snack&drinks'=>'',
    			'soups'=>'',
    			'chips'=>'',
    			'payment'=>''];
    	$cart = Cart::all();
    	$deliveryfee = $this->deliveryfee($request);
    	$totalprice = Cart::total() + $deliveryfee;
    	$totalnumber = Cart::count();
    	
    	return view('frontend.home.dish.dish_content',compact('materials','dish','cart','totalprice','totalnumber','veges','meat'))
    	->withOrderroute($order_route)
    	->withDeliveryfee($deliveryfee)
    	->withActive($active);
//     	dd($materials);
    }
    
    public function adddish(Request $request){
//     	dd($request->input('dish_num'));  
//     	"takeout" => "3,"
//       "extra" => "5,4,"
//       "dish_num" => "30"
//       "num" => "5"
//       "_token" => "AqfUF8PS4jOm44ooDp98HwrAz5HORN1ZjxNWn25R"
    	$this->validate($request, [
    			'dish_num' => 'required|numeric',
    			'num' => 'required|numeric',
    	]);
    	$attribute =[];
    	$extra_money = 0;
    	if($request->get('flavour')!= 'Normal'){
    		$attribute['flavour'] = $request->get('flavour');
    	}
    	if($request->input('takeout')!=''){
    		$takeout = substr($request->input('takeout'),0,strlen($request->input('takeout'))-1);
    		$materials = explode(",",$takeout);
    		$i = 0;
    		foreach ($materials as $mat){
    			$material = Material::findOrFail($mat);
    			$attribute['takeout'][$i]['id'] = $material->id;
    			$attribute['takeout'][$i]['name'] = $material->name;
    			$i++;
    		}
    	}
    	
    	if($request->input('extra')!=''){
    		$extra = substr($request->input('extra'),0,strlen($request->input('extra'))-1);
    		$materials = explode(",",$extra);
    		$i = 0;
    		foreach ($materials as $mat){
    			$material = Material::findOrFail($mat);
    			$attribute['extra'][$i]['id'] = $material->id;
    			$attribute['extra'][$i]['name'] = $material->name;
    			$attribute['extra'][$i]['price'] = $material->price;
    			$extra_money += $material->price;
    			$i++;
    		}
    	}
    	
    	//no just add one 
    	$dish = Dishes::where('number',$request->input('dish_num'))->first();
    	 
    	Cart::add($dish->id, $dish->name,$request->input('num'),$dish->price+$extra_money,$attribute);
    	
//     	dd(Cart::all());
    	//     	return $request->input('id');
    	//     	return Cart::all()."Total:".Cart::total();
    	
    	return redirect()->route('home.menu.types', $dish->catalogue->last()->name);
    	
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
    			'id' => 'required',
    	]);
    	
    	$item = Cart::get($request->input('id'));
    	
    	Cart::update($request->input('id'),$item->qty+1); // Will update the quantity
    	
//     	dd(Cart::all());
    	
//     	$dish = Dishes::where('id',$request->input('id'))->first();
    	
//     	Cart::addone($dish->id, $dish->name, $dish->price);
//     	return $request->input('id');
//     	return Cart::all()."Total:".Cart::total();

    	return redirect()->back();
//     	return redirect()->route('home.menu.types', 'noodles');
//     	return $this->shoppingcart($request);
    	
    }
    
    public function removetoorder(Request $request){
    	$this->validate($request, [
    			'id' => 'required',
    	]);
    	
    	Cart::remove($request->input('id'));
    	return redirect()->back();
//     	return $this->shoppingcart($request);
    	
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
