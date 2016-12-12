<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cart;
use Carbon\Carbon;
use App\Models\Order\orders;
use App\Events\OrderReceipt;
use App\Events\OrderPrinter;
use App\Events\DashboardOrder;
use App\Models\Order\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Shop\Shops;

class paymentcontroller extends Controller
{
	protected $cart;
	protected $totalprice;
	protected $totalnumber;
	
	/*
	 * use auth middleware
	 */
	public function __construct(){
		$this->middleware('ordertypeMiddleware');
		$this->middleware('cartMiddleware');
		$this->middleware('IPMiddleware');
		$this->shop = Shops::first();
		$this->user = Auth::user();
		$this->cart= Cart::all();
		$this->totalprice = Cart::total();
		$this->totalnumber = Cart::count();
	}

	/**
	 * 
	 * @param Request $request
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
		
		$pickupmark =false;
		if($request->session()->get('ordertype')=='pickup'){
			$pickupmark = true;
		}
		
		return view('frontend.home.payment.paymentmethod')
		->withCart($this->cart)
		->withTotalprice($this->totalprice)
		->withTotalnumber($this->totalnumber)
		->withOrderroute($order_route)
		->withShop($this->shop)
		->withPickupmark($pickupmark);
	}
	
	public function cash(Request $request){
// 		Cart::inputMessage("hello word");
// 		return Cart::getMessage();
		
		$time = $this->get_time($request->session()->get('ordertime'));
		//cash payment method, paymentmethod:1 
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
			
			return redirect()->route('home.payment.paymentmethod');
			
		}
		
	}
	
	/**
	 *
	 * @param Request $request
	 */
	public function credittaken(Request $request){
		$datas = $request->all();
// 		dd($datas);
		
// 		\Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
		
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
		
// 		if(!Auth::guest()){
// 			dd($this->user);
// 			// 			$this->user->attachorder($order);
// 		}
		
		return $this->user;
		
		
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
				'ordertype'=>$request->session()->get('ordertype'),
				'name'=>$request->session()->get('user_details')['name'],
				'email'=>$request->session()->get('user_details')['email'],
				'phonenumber'=>$request->session()->get('user_details')['phone'],
				'paymentflag'=>$paymentflat,
				'staff_id'=>1,
				'paymentmethod_id'=>$request->session()->get('paymentmethod'),
				'paymenttime'=>Carbon::now(),
				'shiptime'=>$shiptime,
				'userip'=>$request->ip(),
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
		if($request->session()->get('ordertype')=='delivery'){
			$address = new Address([	
						'address'=>$request->session()->get('user_details')['address'],
						'suburb'=>$request->session()->get('user_details')['suburb'],
						'city'=>$request->session()->get('user_details')['city']
					]);
			
// 			$address = Address::create($user_address);
			$order->address()->save($address);
		}
		
		if(!Auth::guest()){
// 			dd($this->user);
			$this->user->attachorder($order);
		}
		
		event(new OrderReceipt($order));
		event(new OrderPrinter($order));
		event(new DashboardOrder());
		
		/* clear shopping cart		 */
		Cart::clean();

		sweetalert_message()->top_message(trans("front_home.order_cancel"));
		
		Mail::queue('emails.order.receipt',compact('order'),function ($message)use($order){
			$message->from(env('MAIL_USERNAME'))->to($order->email)
			->subject('Noodle Canteen Receipt');
		});
		
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
	
}
