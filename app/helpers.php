<?php
use App\Models\Shop\Coupons;
use Carbon\Carbon;
use App\Models\Order\Orders;
use App\Repositories\Prints\Printer;
use App\Models\Shop\Shops;

/*
 * Global Flash functions.
 */
if ( ! function_exists('sweetalert_message')) {

	/**
	 * Arrange for a flash message.
	 *
	 * @param  string|null $message
	 * @return \Laracasts\Flash\FlashNotifier
	 */
 	function sweetalert_message($message = null,$title=null)
    {
    	$notifier = app('App\Repositories\Flash\sweetalert');
    	
    	if(func_num_args()==0){
    		return $notifier;
    	}

    	return $notifier;
    }

}

/**
 * 
 */
if (! function_exists('deliveryfee')) {

    function deliveryfee($request,$freedelivery,$maxfree)
    {
//     	return $request->session()->get('user_details')['deliveryfee'];
       $deliveryfee = 0;
    	if($request->session()->get('ordertype')=='pickup'){
    		return $deliveryfee;
    	}
    	
    	if(!empty($request->session()->get('user_details')['deliveryfee'])){
    		$cart = Cart::alldetails();
//     		if(($cart['total'] < $freedelivery)|| ($request->session()->get('user_details')['deliveryfee']>$maxfree)){
    			$deliveryfee = $request->session()->get('user_details')['deliveryfee'];
//     		}
    	}
    	return $deliveryfee;
    }
}

/**
 *
 * @return unknown
 */
if (! function_exists('getcoupon')) {
	
	function getcoupon($request,$coupon_maxamount,$coupon_maxvalue,$allow){
		$coupon_count = Coupons::where('used_time', '>', Carbon::today())
		->Where('used_time', '<', Carbon::tomorrow())
		->Where('used','=',1)
		->count();
		
		if(!$allow){
			return false;
		}
		if($coupon_count>=$coupon_maxamount){
			return false;
		}
		
		if($request->session()->has('coupon')){
// 			return Coupons::findOrFail(4);
			$coupon =  Coupons::where('code',$request->session()->get('coupon'))->first();
// 			return $request->session()->get('coupon');
			if($coupon->value<=$coupon_maxvalue){
				return $coupon;
			}
		}
		return false;
	}
	
}

if(!function_exists('feieprinter')){
	function feieprinter(orders $order,Shops $shop) {
		$printer = new Printer ();
		return $printer->print_order ( $order, $shop);
	}
}


if (! function_exists('access')) {
	/**
	 * Access (lol) the Access:: facade as a simple function
	 */
	function access()
	{
		return app('access');
	}
}