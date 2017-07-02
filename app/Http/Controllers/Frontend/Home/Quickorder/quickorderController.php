<?php

namespace App\Http\Controllers\Frontend\Home\Quickorder;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order\orders;
use Cart;
use App\Models\Shop\Shops;
use App\Models\Menu\Dishes;

class quickorderController extends Controller
{
	public function __construct(){
		$this->shop = Shops::first();
		$this->user = Auth::user();
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	sweetalert_message()->top_message(trans("front_home.order_cancel"));
    	
//     	dd($this->user);
//     	return $this->user->descorders();
    	return view('frontend.home.quickorder.index')
    	->withuser($this->user)
    	->withShop($this->shop);
//     	->withFlashSuccess("error");
//     	->withMessage(trans('front_home.qorder_intro'));
    	
    }
    
    public function cloneorder(Request $request){
    	
    	$this->validate($request, [
    			'orderid' => 'required|numeric'
    	]);
    	
    	if($this->user->hasorder($request->input('orderid'))){
    		$order = orders::findOrFail($request->input('orderid'));
//     		$request->session()->flush();
    		$request->session()->forget('user_details');
    		$request->session()->forget('ordertype');
    		Cart::destroy();
//     		Session
    		if($order->ordertype == "pickup"){
    			$datas= [ 'name' =>$order->name,
        			'phone' => $order->phonenumber,
        			'email' =>$order->email,
    			];
    			$request->session()->put('user_details', $datas);
    			$request->session()->put('ordertype', "pickup");
    			
    			if($request->session()->has('user_details')){
//     				return "error";
					foreach ($order->orderitems as $item){
						$dish = Dishes::findOrFail($item->dishes_id);
						$extra_money =0;
						$attribute =[];
// 						$dish->pivot->amount
						if ($item->takeout) {
							$i=0;
							foreach ( $item->takeout as $takeout ) {
								$attribute['takeout'][$i]['id'] = $takeout->id;
								$attribute['takeout'][$i]['name'] = $takeout->name;
								$i++;
							}
						}
							
						if ($item->extra) {
							$i=0;
							foreach ( $item->extra as $extra ) {
								$attribute['extra'][$i]['id'] = $extra->id;
								$attribute['extra'][$i]['name'] = $extra->name;
								$attribute['extra'][$i]['price'] = $extra->price;
								$extra_money += $extra->price;
								$i++;
							}
						}
						
						
						Cart::add($dish->number, $dish->name,$item->amount, $dish->price+$extra_money,$attribute);
// 						Cart::add($dish->id, $dish->name,$request->input('num'),$dish->price+$extra_money,$attribute);
						
					}
    				return redirect()->route('home.ordertime');
    			}else{
    				return redirect()->route('home.pickup.info');
    			}
    		}elseif ($order->ordertype == "delivery"){
    			$datas= [ 'name' =>$order->name,
    					'phone' => $order->phonenumber,
    					'email' =>$order->email,
    					'address'=>$order->address->address,
    					'suburb'=>$order->address->suburb,
    					'city'=>$order->address->city
    			];
    			$request->session()->put('user_details', $datas);
    			$request->session()->put('ordertype', "delivery");
    			
    			if($request->session()->has('ordertype')){
    				foreach ($order->dishes as $dish){
    					// 						$dish->pivot->amount
    					Cart::add($dish->number, $dish->name,$dish->pivot->amount, $dish->price);
    				}
    				
    				return redirect()->route('home.ordertime');
    			}
    			return redirect()->route('home.delivery.confirm');
    			
    		}
    		
    	}
//     	return $request->input('orderid');
    	
//     	if($request->input('orderid')){
    		
//     	}
    	
//     	return "clone order";
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//     	$message = trans('front_home.qorder_intro');
//     	return redirect()->route('home.quickorder',[$message]);
//     	return redirect('home/quickorder')->with('regist', true);

    	$order = orders::findOrFail(133);
    	dd($this->user);
    	if(!Auth::guest()){
    		$this->user->attachorder($order);
    	}
    }

}
