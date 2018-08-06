<?php
namespace App\Http\Controllers\Frontend\Home\Payment;
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
use App\Repositories\Prints\Printer;
use App\Models\Order\Orderitems;
use Stripe\Coupon;
use App\Models\Shop\Coupons;
// use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use App\Models\Element\Material;
class paymentcontroller extends Controller {
	protected $cart;
	protected $totalprice;
	protected $totalnumber;
	
	/*
	 * use auth middleware
	 */
	public function __construct() {
		$this->middleware ( 'ordertypeMiddleware' );
		$this->middleware ( 'cartMiddleware' );
		$this->middleware ( 'IPMiddleware' );
		$this->shop = Shops::first ();
		$this->user = Auth::user ();
		$this->cart = Cart::all ();
		$this->totalprice = Cart::total ();
		$this->totalnumber = Cart::count ();
		$this->active = [ 
				'menu' => '',
				'noodles' => '',
				'rice' => '',
				'snack&drinks' => '',
				'soups' => '',
				'chips' => '',
				'payment' => 'active' 
		
		];
	}
	
	/**
	 *
	 * @param Request $request        	
	 * @return unknown
	 */
	public function paymentmethod(Request $request) {
		
		// $cart = Cart::all();
		// Cart::inputMessage($request->input('message'));
		
		// return $message = Cart::getMessage();
		// Cart::saveMessage($request->input('message'));
		
		// return $request->all();
		$order_route = [ 
				'prev' => route ( 'home.menu.types', [ 
						'types' => 'noodles' 
				] ),
				'next' => '' 
		];
		
		$pickupmark = false;
		if ($request->session ()->get ( 'ordertype' ) == 'pickup') {
			$pickupmark = true;
		}
		
		$deliveryfee = deliveryfee ( $request, $this->shop->freedelivery, $this->shop->maxfree );
		$coupon_value = 0;
		$coupon = getcoupon ( $request, $this->shop->coupon_maxamount, $this->shop->coupon_maxvalue,$this->shop->coupon);
		
		if ($coupon) {
			$coupon_value = $coupon->value;
		}
		if (Cart::total () <= $coupon_value) {
			$totalprice = Cart::total () + $deliveryfee;
		} else {
			$totalprice = Cart::total () + $deliveryfee - $coupon_value;
		}
		
		return view ( 'frontend.home.payment.paymentmethod' )->withCart ( $this->cart )->withTotalprice ( $totalprice )
		->withTotalnumber ( $this->totalnumber )->withOrderroute ( $order_route )->withShop ( $this->shop )->withPickupmark ( $pickupmark )->withDeliveryfee ( $deliveryfee )->withCoupon ( $coupon )->withActive ( $this->active );
	}
	public function cash(Request $request) {
		// return Cart::getMessage();
		$time = $this->get_time ( $request->session ()->get ( 'ordertime' ) );
		// cash payment method, paymentmethod:1
		$request->session ()->put ( 'paymentmethod', 1 );
		
		if ($request->session ()->has ( 'paymentmethod' )) {
			$order_route = [ 
					'prev' => route ( 'home.payment.paymentmethod' ),
					'next' => '' 
			];
			
			$deliveryfee = deliveryfee ( $request, $this->shop->freedelivery, $this->shop->maxfree );
			$coupon_value = 0;
			$coupon = getcoupon ( $request, $this->shop->coupon_maxamount, $this->shop->coupon_maxvalue,$this->shop->coupon );
			
			if ($coupon) {
				$coupon_value = $coupon->value;
			}
			if (Cart::total () <= $coupon_value) {
				$totalprice = Cart::total () + $deliveryfee;
			} else {
				$totalprice = Cart::total () + $deliveryfee - $coupon_value;
			}
			
			$ip = $request->ip ();
			
			if ($request->session ()->get ( 'ordertype' ) == 'delivery') {
// 				$totalprice = 111.1;
				$change = '$'.$this->change($totalprice);
				
				return view ( 'frontend.home.payment.cash', compact ( 'time', 'ip' ) )->withCart ( $this->cart )
				->withTotalprice ( $totalprice )
				->withTotalnumber ( $this->totalnumber )
				->withOrderroute ( $order_route )
				->withDeliveryfee ( $deliveryfee )
				->withCoupon($coupon)
				->withShop($this->shop)
				->withActive ( $this->active)
				->withChange($change);
			}else{
				return view ( 'frontend.home.payment.payinshop', compact ( 'time', 'ip' ) )->withCart ( $this->cart )
				->withTotalprice ( $totalprice )
				->withTotalnumber ( $this->totalnumber )
				->withOrderroute ( $order_route )
				->withDeliveryfee ( $deliveryfee )
				->withCoupon($coupon)
				->withShop($this->shop)
				->withActive ( $this->active );
			}
			
			
			
		} else {
			return redirect ()->route ( 'home.payment.paymentmethod' );
		}
	}
	
	/**
	 *
	 * @param Request $request        	
	 */
	public function credittaken(Request $request) {
		$datas = $request->all ();
		// dd($datas);
		
		// \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
		
		// Get the credit card details submitted by the form
		$token = $_POST ['stripeToken'];
		
		// Create the charge on Stripe's servers - this will charge the user's card
		try {
			$charge = \Stripe\Charge::create ( array (
					"amount" => $this->totalprice * 100, // amount in cents, again
					"currency" => "NZD",
					"source" => $datas ['stripeToken'],
					"description" => "Credit Card" 
			) );
		} catch ( \Stripe\Error\Card $e ) {
			// The card has been declined
		}
	}
	
	/*
	 *
	 */
	public function credit(Request $request) {
		$time = $this->get_time ( $request->session ()->get ( 'ordertime' ) );
		
		$request->session ()->put ( 'paymentmethod', 2 );
		
		if ($request->session ()->has ( 'paymentmethod' )) {
			
			$order_route = [ 
					'prev' => route ( 'home.payment.paymentmethod' ),
					'next' => '' 
			];
			
			return view ( 'frontend.home.payment.credit', compact ( 'time' ) )->withCart ( $this->cart )->withTotalprice ( $this->totalprice )->withTotalnumber ( $this->totalnumber )->withOrderroute ( $order_route );
		} else {
			$order_route = [ 
					'prev' => route ( 'home.menu.index' ),
					'next' => '' 
			];
			return view ( 'frontend.home.payment.paymentmethod' )->withCart ( $this->cart )->withTotalprice ( $this->totalprice )->withTotalnumber ( $this->totalnumber )->withOrderroute ( $order_route );
		}
	}
	
	/*
	 * create an order to user
	 */
	public function placeorder(Request $request) {
		if ($request->session ()->get ( 'ordertime' ) != "ASAP") {
			$shiptime = Carbon::createFromTimestamp ( $request->session ()->get ( 'ordertime' ) )->toDateTimeString ();
		} else {
			$shiptime = Carbon::now ();
		}
		
		$paymentflat = 1;
		
		$deliveryfee = 0;
		if ($request->session ()->get ( 'ordertype' ) == 'delivery') {
			$deliveryfee = deliveryfee ( $request, $this->shop->freedelivery, $this->shop->maxfree );
		}
		
		$coupon = getcoupon ( $request, $this->shop->coupon_maxamount, $this->shop->coupon_maxvalue,$this->shop->coupon );
		$coupon_value = 0;
		
		if ($coupon && $coupon->expired_time > Carbon::now () && ! $coupon->used) {
			$coupon_value = $coupon->value;
		}
		
		if (Cart::total () <= $coupon_value) {
			$totalprice = $this->totalprice + $deliveryfee;
		} else {
			$totalprice = $this->totalprice + $deliveryfee - $coupon_value;
		}
		
		$data = [ 
				'ordernumber' => date ( 'Ymd' ) . random_int ( 100000, 999999 ),
				'total' => $this->totalprice,
				'totaldue' => $totalprice,
				'status' => '1',
				'ordertype' => $request->session ()->get ( 'ordertype' ),
				'name' => $request->session ()->get ( 'user_details' ) ['name'],
				'email' => $request->session ()->get ( 'user_details' ) ['email'],
				'phonenumber' => $request->session ()->get ( 'user_details' ) ['phone'],
				'paymentflag' => $paymentflat,
				'staff_id' => 1,
				'paymentmethod_id' => $request->session ()->get ( 'paymentmethod' ),
				'paymenttime' => Carbon::now (),
				'shiptime' => $shiptime,
				'userip' => $request->ip (),
				'shipmethod' => 'take away',
				'message' => $request->input ( 'message' ) 
		];
		
		$order = orders::create ( $data );
		// dd($this->cart);
		foreach ( $this->cart as $item ) {
			// $order->dishes()->attach($item->id,
			// array( 'amount'=>$item->qty,
			// 'price'=>$item->price,
			// 'total'=>$item->price*$item->qty
			// )
			// );
			if (! $item->flavour) {
				$item->flavour = '';
			}
			if (! $item->selectspecial) {
				$item->selectspecial= '';
			}else{
				//get the material id by name
				$item->selectspecial = Material::where('name', $item->selectspecial)->first()->id;
			}
// 			$item->selectspecial= '38';
			$orderitem = new Orderitems ( [ 
					'dishes_id' => $item->id,
					'flavour' => $item->flavour,
					'selectspecial'=> $item->selectspecial,
					'amount' => $item->qty,
					'price' => $item->price,
					'total' => $item->price * $item->qty 
			] );
			$order->orderitems ()->save ( $orderitem );
			
			// $order->orderitems()->attach($item->id,
			// array( 'amount'=>$item->qty,
			// 'price'=>$item->price,
			// 'total'=>$item->price*$item->qty
			// )
			// );
			
			// dd($item->takeout);
			if ($item->takeout) {
				foreach ( $item->takeout as $takeout ) {
					$orderitem->materials ()->attach ( $takeout ['id'], array (
							'type' => 'takeout',
							'price' => '0' 
					) );
				}
			}
			
			if ($item->extra) {
				foreach ( $item->extra as $extra ) {
					$orderitem->materials ()->attach ( $extra ['id'], array (
							'type' => 'extra',
							'price' => $extra ['price'] 
					) );
				}
			}
		}
		if ($request->session ()->get ( 'ordertype' ) == 'delivery') {
			$address = new Address ( [ 
					'address' => $request->session ()->get ( 'user_details' ) ['address'],
					'suburb' => $request->session ()->get ( 'user_details' ) ['suburb'],
					'city' => $request->session ()->get ( 'user_details' ) ['city'],
					'fee' => $deliveryfee 
			] );
			
			// $address = Address::create($user_address);
			$order->address ()->save ( $address );
			
// 			Redis::set('DELIVERY_TYPE' . $request->session ()->get ( 'user_details' ) ['email'], $request->session ());
		}
		
// 		Redis::set('USER_DETAILS' . $request->session ()->get ( 'user_details' ) ['email'], $order->id);
// 		Cookie::queue('user_details_cookie', $request->session ()->get ( 'user_details' ) ['email'], 45000);
// 		$request->session()->put('email',$request->session ()->get ( 'user_details' ) ['email']);
// 		Cache::add('email', $request->session ()->get ( 'user_details' ) ['email'], 34560);
			
		// dd($coupon['id']);
		if ($coupon && $coupon->expired_time > Carbon::now () && ! $coupon->used) {
			$coupon->used_time = Carbon::now ();
			$coupon->used = 1;
			$coupon->save ();
			$order->coupon ()->save ( $coupon );
			$request->session ()->forget ( 'coupon' );
		}
		
		// dd($coupon);
		
		if (! Auth::guest ()) {
			// dd($this->user);
			$this->user->attachorder ( $order );
		}
		
		// $printresult = false;
		
// 		dd($this->feieprinter($order));
		if(!$this->feieprinter($order)){
		//send me a email.
		$num = orders::where('status','<','2')->count();
		Mail::queue('emails.order.printfail',compact('num','order'),function ($message)use($order){
		$message->from(env('MAIL_USERNAME'))->to($order->email)
		->subject('Noodle Canteen Print Errors');
		});
		}
		
		// event
		event ( new OrderReceipt ( $order ) );
		event ( new OrderPrinter ( $order ) );
		event ( new DashboardOrder () );
		
		/* clear shopping cart */
		Cart::clean ();
		
		sweetalert_message ()->top_message ( trans ( "front_home.order_cancel" ) );
		
		Mail::queue ( 'emails.order.receipt', compact ( 'order' ), function ($message) use ($order) {
			$message->from ( env ( 'MAIL_USERNAME' ) )->to ( $order->email )->subject ( 'Noodle Canteen Receipt' );
		} );
		
		return view ( 'frontend.home.payment.ordercreated' )->withOrder ( $order )->withShop ( $this->shop );
	}
	protected function feieprinter(orders $order) {
		$printer = new Printer ();
		return $printer->print_order ( $order, $this->shop );
	}
	
	/* get the display time to user */
	protected function get_time($timestamp) {
		if ($timestamp != "ASAP") {
			$dt = Carbon::createFromTimestamp ( $timestamp );
			return $dt->format ( 'h:i A l jS F Y' );
		}
		return $timestamp;
	}
	
	protected function change($n){
		$money = ceil($n);
		
		if($money>100){
			$number = $money%10;
			$money=(int)($money/10);
			$decade = $money%10;
			$hundred = (int)($money/10);
			return $hundred*100+(++$decade)*10-$n;
		}else{
			$decade= (int)($money/10);
			return (++$decade)*10-$n;
// 			$number = $money%10;
// 			if($number<=5){
// 				return $decade*10+5;
// 			}else{
// 				return ($decade++)*10;
// 			}
		}
		
	}
}