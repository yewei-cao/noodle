<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cart;
use Carbon\Carbon;
use App\Models\Order\orders;
use App\Events\OrderReceipt;
use App\Events\DashboardOrder;

class paymentcontroller extends Controller
{
	protected $cart;
	protected $totalprice;
	protected $totalnumber;
	
	/*
	 * use auth middleware
	 */
	public function __construct(){
		$this->middleware('pickupdetail');
		$this->cart= Cart::all();
		$this->totalprice = Cart::total();
		$this->totalnumber = Cart::count();
	}

	/*
	 * 
	 */
	public function paymentmethod(Request $request){
		
// 		$cart = Cart::all();
// 		Cart::inputMessage($request->input('message'));
				
// 		return $message = Cart::getMessage();
// 		Cart::saveMessage($request->input('message'));

// 		return $request->all();

		$order_route=[
				'prev'=>route('home.menu.index'),
				'next'=>''
		];
		
		return view('frontend.home.payment.paymentmethod')
		->withCart($this->cart)
		->withTotalprice($this->totalprice)
		->withTotalnumber($this->totalnumber)
		->withOrderroute($order_route);
	}
	
	public function cash(Request $request){
// 		Cart::inputMessage("hello word");
// 		return Cart::getMessage();
		
		$time = $this->get_time($request->session()->get('ordertime'));
		$request->session()->put('paymentmethod', 1);
		
		if($request->session()->has('paymentmethod')){
			$order_route=[
					'prev'=>route('home.payment.paymentmethod'),
					'next'=>''
			];
			
			$ip = $request->ip();
			return view('frontend.home.payment.cash',compact('time','ip'))
			->withCart($this->cart)
			->withTotalprice($this->totalprice)
			->withTotalnumber($this->totalnumber)
			->withOrderroute($order_route);
		}else{
			
			$order_route=[
					'prev'=>route('home.menu.index'),
					'next'=>''
			];
			
			return view('frontend.home.payment.paymentmethod')
			->withCart($this->cart)
			->withTotalprice($this->totalprice)
			->withTotalnumber($this->totalnumber)
			->withOrderroute($order_route);
		}
		
	}
	
	/**
	 *
	 * @param Request $request
	 */
	public function credittaken(Request $request){
		$datas = $request->all();
// 		dd($datas);
		
		\Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
		
		// Get the credit card details submitted by the form
		$token = $_POST['stripeToken'];
		
		// Create the charge on Stripe's servers - this will charge the user's card
		try {
			$charge = \Stripe\Charge::create(array(
					"amount" => $this->totalprice*100, // amount in cents, again
					"currency" => "NZD",
					"source" => $datas['stripeToken'],
					"description" => "Credit Card"
			));
		} catch(\Stripe\Error\Card $e) {
			// The card has been declined
		}
	}
	
	public function poli(){
		return "poli";
	}
	
	/*
	 * 
	 */
	public function credit(Request $request){
		$time = $this->get_time($request->session()->get('ordertime'));
		
		$request->session()->put('paymentmethod', 2);
		
		
		if($request->session()->has('paymentmethod')){
			
			$order_route=[
					'prev'=>route('home.payment.paymentmethod'),
					'next'=>''
			];
			
			return view('frontend.home.payment.credit',compact('time'))
				->withCart($this->cart)
				->withTotalprice($this->totalprice)
				->withTotalnumber($this->totalnumber)
				->withOrderroute($order_route);
		}else{
			$order_route=[
					'prev'=>route('home.menu.index'),
					'next'=>''
			];
			return view('frontend.home.payment.paymentmethod')
			->withCart($this->cart)
			->withTotalprice($this->totalprice)
			->withTotalnumber($this->totalnumber)
			->withOrderroute($order_route);
		}
	}
	
	
	public function confirm(Request $request){
		return "confirm page";
	}
	
	/*
	 * create a order to user
	 */
	public function placeorder(Request $request){
		
		if($request->session()->get('ordertime')!="ASAP"){
			$shiptime = Carbon::createFromTimestamp($request->session()->get('ordertime'))->toDateTimeString();
		}else{
			$shiptime = Carbon::now();
		}
		
		$paymentflat = 1;
		$data = [
				'ordernumber'=> date('Ymd') .random_int(100000, 999999),
				'total'=>$this->totalprice,
				'totaldue'=>$this->totalprice,
				'status'=>'1',
				'name'=>$request->session()->get('pickup_deatils')['name'],
				'email'=>$request->session()->get('pickup_deatils')['email'],
				'phonenumber'=>$request->session()->get('pickup_deatils')['phone'],
				'paymentflag'=>$paymentflat,
				'staff_id'=>1,
				'paymentmethod_id'=>$request->session()->get('paymentmethod'),
				'paymenttime'=>Carbon::now(),
				'shiptime'=>$shiptime,
				'shipmethod'=>'take away',
				'message'=>$request->input('message'),
		];
		
		$order = Orders::create($data);
		foreach ($this->cart as $item) {
			$order->dishes()->attach($item->id,
					array(	'amount'=>$item->qty,
							'price'=>$item->price,
							'total'=>$item->price*$item->qty
					)
					);
		}
		
		event(new OrderReceipt($order));
		event(new DashboardOrder());
		
		/* clear shopping cart		 */
		Cart::clean();

		return view('frontend.home.payment.ordercreated')
		->withOrder($order);
		
	}
	
	/* get the display time to user */
	protected function get_time($timestamp){
		if($timestamp!="ASAP"){
			$dt = Carbon::createFromTimestamp($timestamp);
			return $dt->format('h:i A l jS F Y');
		}
		return $timestamp;
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
