<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cart;

class paymentcontroller extends Controller
{

	public function paymentmethod(Request $request){
		
		/* if session expired, then route to home page. */
		if((!$request->session()->has('pickup_deatils'))||(!$request->session()->has('ordertime'))){
			sweetalert_message()->n_overlay(trans("menus.session.expire"),'Session Expire');
			return redirect()->route('home');
		}
		
		$cart = Cart::all();
		$totalprice = Cart::total();
		$totalnumber = Cart::count();
		
		return view('frontend.home.payment.paymentmethod',compact('cart','totalprice','totalnumber'));
		
// 		return "paymentmethod page";
	}
	
	public function cash(Request $request){
		/* if session expired, then route to home page. */
		if((!$request->session()->has('pickup_deatils'))||(!$request->session()->has('ordertime'))){
			sweetalert_message()->n_overlay(trans("menus.session.expire"),'Session Expire');
			return redirect()->route('home');
		}
		
		$cart = Cart::all();
		$totalprice = Cart::total();
		$totalnumber = Cart::count();
		$time = $request->session()->get('ordertime');
		
		$ip = $request->ip();
		return view('frontend.home.payment.cash',compact('cart','totalprice','totalnumber','time','ip'));
		
	}
	
	
	public function credit(Request $request){
		/* if session expired, then route to home page. */
		if((!$request->session()->has('pickup_deatils'))||(!$request->session()->has('ordertime'))){
			sweetalert_message()->n_overlay(trans("menus.session.expire"),'Session Expire');
			return redirect()->route('home');
		}
		
		$cart = Cart::all();
		$totalprice = Cart::total();
		$totalnumber = Cart::count();
		$time = $request->session()->get('ordertime');
		
		$ip = $request->ip();
		return view('frontend.home.payment.credit',compact('cart','totalprice','totalnumber','time'));
	}
	
	
	public function confirm(Request $request){
// 		return view('frontend.home.payment.confirm');

		return "confirm page";
	}
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
