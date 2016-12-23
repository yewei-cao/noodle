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

class poliController extends Controller
{
	
	protected $cart;
	
	public function __construct(){
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
	public function poli(Request $request){
	
		$token = str_random(32);
	
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
				'token'=>$token,
				'paymentflag'=>$paymentflat,
				'staff_id'=>1,
				'paymentmethod_id'=>2,
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
	
		/* clear shopping cart		 */
		Cart::clean();
	
		$this->politransaction($order);
	
	}
	
	
	public function polisuccess(Request $request){
		$this->validate($request, [
				'token'=>'required',
		]);
	
		$id = $this->getorder($request->get('token'));
		
		if( !intval( $id ) ){
			sweetalert_message()->n_overlay($id.' You can place an other order','Payment Fail');
			return redirect()->route('home');
		}
		
		$order = Orders::findOrFail($id);
		if($order->paymentflag ==2){
			event(new OrderReceipt($order));
			event(new OrderPrinter($order));
			event(new DashboardOrder());
			
			sweetalert_message()->top_message(trans("front_home.order_cancel"));
			
			Mail::queue('emails.order.receipt',compact('order'),function ($message)use($order){
				$message->from(env('MAIL_USERNAME'))->to($order->email)
				->subject('Noodle Canteen Receipt');
			});
			
				return view('frontend.home.payment.ordercreated')
				->withOrder($order);
		}
		
	}
	
	public function polinudge(Request $request){
		$this->validate($request, [
				'token'=>'required',
		]);
		getorder($request->get('token'));
	}
	
	public function getorder($token){
		$auth = base64_encode('SS64006197:lR8^D83sn7M6Z');
		$header = array();
		$header[] = 'Authorization: Basic '.$auth;
		
		$ch = curl_init("https://poliapi.apac.paywithpoli.com/api/Transaction/GetTransaction?token=".urlencode($token));
		//See the cURL documentation for more information: http://curl.haxx.se/docs/sslcerts.html
		//We recommend using this bundle: https://raw.githubusercontent.com/bagder/ca-bundle/master/ca-bundle.crt
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_POST, 0);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec( $ch );
		curl_close ($ch);
		
		$json = json_decode($response, true);
// 		dd($json);
		
		if (array_key_exists("ErrorMessage",$json)){
			return "The transaction token provided is corrupted.";
		}
		if($json['TransactionStatusCode']!='Completed'){
			return "Transaction not completed.";
		}
		
		if(!Orders::where('token', $json['MerchantReferenceData'])->count()){
			return "Token is not available.";
		}
		
		
		$order = Orders::where('token', $json['MerchantReferenceData'])->first();
		$order->paymentflag = 2;
		$order->save();
		
		return $order->id;
	}
	
	/**
	 *
	 * @param unknown $order
	 */
	public function politransaction($order){
		$data = '{
		  "Amount":"'.$order->total.'",
		  "CurrencyCode":"NZD",
		  "MerchantData":"'.$order->token.'",
		  "MerchantReference":"'.$order->ordernumber.'",
		  "MerchantHomepageURL":"'.route('home').'",
		  "SuccessURL":"'.route('home.payment.polisuccess').'",
		  "FailureURL":"https://www.mycompany.com/Failure",
		  "CancellationURL":"https://www.mycompany.com/Cancelled",
		  "NotificationURL":"'.route('home.payment.polinudge').'"
		}';
	
		$auth = base64_encode('SS64006197:lR8^D83sn7M6Z');
		$header = array();
		$header[] = 'Content-Type: application/json';
		$header[] = 'Authorization: Basic '.$auth;
	
		$ch = curl_init("https://poliapi.apac.paywithpoli.com/api/Transaction/Initiate");
		//See the cURL documentation for more information: http://curl.haxx.se/docs/sslcerts.html
		//We recommend using this bundle: https://raw.githubusercontent.com/bagder/ca-bundle/master/ca-bundle.crt
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec( $ch );
		curl_close ($ch);
	
		$json = json_decode($response, true);
	
		header('Location: '.$json["NavigateURL"]);
	
	}
	
	
}
