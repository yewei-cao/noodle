<?php

namespace App\Http\Controllers\Frontend\Home\Quickorder;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order\Orders;
use Cart;

class quickorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	sweetalert_message()->top_message(trans("front_home.order_cancel"));
    	
//     	return $this->user->descorders();
    	return view('frontend.home.quickorder.index')
    	->withuser($this->user);
//     	->withFlashSuccess("error");
//     	->withMessage(trans('front_home.qorder_intro'));
    	
    }
    
    public function cloneorder(Request $request){
    	
    	$this->validate($request, [
    			'orderid' => 'required|numeric'
    	]);
    	
    	if($this->user->hasorder($request->input('orderid'))){
    		$order = Orders::findOrFail($request->input('orderid'));
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
					foreach ($order->dishes as $dish){
// 						$dish->pivot->amount
						Cart::add($dish->number, $dish->name,$dish->pivot->amount, $dish->price);
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
    	
    	dd($request);
    	
//     	return "clone order";
    }
    public function test(){
//     	return "ssss";
    	return redirect()->route('home');
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

    	$order = Orders::findOrFail(133);
    	dd($this->user);
    	if(!Auth::guest()){
    		$this->user->attachorder($order);
    	}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
