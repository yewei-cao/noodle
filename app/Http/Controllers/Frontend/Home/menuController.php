<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Menu\Dishes;
use App\Models\Menu\Catalogue;
use Cart;

class menuController extends Controller
{
    /**
     * Display the menu, includes all catalogues.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//     	$request->session()->flush();
    	
    	/* if session expired, then route to home page. */
    	if((!$request->session()->has('pickup_deatils'))||(!$request->session()->has('ordertime'))){
    		sweetalert_message()->n_overlay(trans("menus.session.expire"),'Session Expire');
    		return redirect()->route('home');
    	}

//     	dd($request->session()->get('ordertime'));
//     	$dish = Dishes::where('number','9')->first();
//     	dd($dish->name);

    	$order_route=[
    			'prev'=>'',
    			'next'=>route('home.payment.paymentmethod')
    	];
    	
    	$catalogues = Catalogue::orderBy('ranking', 'asc')->get();
    	$cart = Cart::all();
    	$totalprice = Cart::total();
    	$totalnumber = Cart::count();
    	return view('frontend.home.menu_content',compact('catalogues','cart','totalprice','totalnumber'))
    	->withOrderroute($order_route);
    }
    
    
    public function addtoorder(Request $request){
    	$this->validate($request, [
    			'id' => 'required|numeric',
    	]);
    	
    	$dish = Dishes::where('number',$request->input('id'))->first();
    	
//     	dd($dish);
    	
//     	Cart::minusone('c42f6beec9c93fd6afea6eb0684aa99a');
    	
    	Cart::addone($dish->number, $dish->name, $dish->price);
//     	return $request->input('id');
//     	return Cart::all()."Total:".Cart::total();

    	$cart = Cart::alldetails();
    	return $cart;
    	
    }
    
    public function removetoorder(Request $request){
    	$this->validate($request, [
    			'id' => 'required',
    	]);
    	
    	Cart::remove($request->input('id'));
    	
    	$cart = Cart::alldetails();
    	return $cart;
    	
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
