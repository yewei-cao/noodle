<?php

namespace App\Http\Controllers\Backend\Order;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order\orders;
use App\Events\OrderPrinter;
use App\Events\DashboardOrder;
use App\Events\OrderReceipt;
use Carbon\Carbon;
use Mapper;
use App\Models\Shop\Shops;
use App\Repositories\Prints\Printer;
use App\Models\Shop\Coupons;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
	protected $paginate = 10;
	protected $path = 'images/voucher.jpg';
	
	public function __construct(){
		$this->shop = Shops::firstOrFail();
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
//     	$orders = orders::where('email','=','yeweicao@gmail.com')
//     	->Where('paymenttime', '>', '2016-01-01 00:00:00')
//     	->Where('status', '=', '4')->get();
    	
// //     	$orders = orders::latest();
//     	dd($orders);
    	
//     	$this->paginate = 15;
//     	if($request->input('paginate')){
//     		$paginate = $request->input('paginate');
//     	}

//     	$orders = orders::where('status','=','2')->paginate($this->paginate);
    	
    	$orders = orders::latest()->paginate($this->paginate);
//     	$orders->appends(['sort' => 'name']);
//     	$orders->setPath('custom/url');
    	
    	$tab='all';
    	
        return view('backend.pages.order.index')
        ->withOrders($orders)
        ->withTab($tab);
    }
    
    public function data(){
    	$today = Carbon::today();
    	$tomorrow = Carbon::tomorrow();
    	$total = $this->getdata($today, $tomorrow);
// 		$totaldeal = $orders->increment('totaldue');
// 		return $total;
    	return view('backend.pages.order.data')->withTotal($total);
    }
    
    public function datachoice($choice){
    	 
    	switch ($choice)	{
    		case $choice =="today":
    			$start = Carbon::today();
    			$end = Carbon::tomorrow();
    			break;
    		case $choice =="yesterday":
    			$dt = Carbon::today();
    			$start = Carbon::yesterday();
    			$end = Carbon::today();
    			break;
    		case $choice =="week":
    			$start = Carbon::today()->startOfWeek();
    			$end = Carbon::today()->endOfWeek();
    			break;
    		case $choice =="lastweek":
    			$star_dt = Carbon::today()->addDays(-7);
    			$end_dt = Carbon::today()->addDays(-7);
    			$start = $star_dt->startOfWeek();
    			$end = $end_dt->endOfWeek();
    			break;
    	}
    	
    	$total = $this->getdata($start, $end);
    	
//     	return $start;
    	return view('backend.pages.order.data')->withTotal($total);
    }
    
    public function getdata($start, $end){
    	$orders =  orders::where('status',4)
    	->where('shiptime','>=',$start)
    	->where('shiptime','<=',$end)->get();
    	 
    	//         return $orders->count();
    	$total = [];
    	$total['orders'] = $orders->count();
    	$total['deal'] = 0;
    	$total['meals'] = 0;
    	$total['delivery'] = 0;
    	$total['deliveryfee'] = 0;
    	$total['pickup'] = 0;
    	foreach ($orders as $order){
    		$total['deal'] += $order->totaldue;
    			
    		foreach ($order->orderitems as $item){
    			$total['meals'] += $item->amount;
    		}
    		if($order->ordertype =="delivery"){
    			$total['delivery']++;
    			$total['deliveryfee']+=$order->address->fee;
    		}
    		if($order->ordertype =="pickup"){
    			$total['pickup']++;
    		}
    	}
    	return $total;
    }
    
    /*
     * 
     */
    public function tab($tab){
    	
    	switch ($tab)	{
    		case $tab =="unpaid":
    			$orders = orders::where('paymentflag','=','1')->latest()->paginate($this->paginate);
    			break;
    		case $tab =="paid":
    			$orders = orders::where('paymentflag','=','2')->latest()->paginate($this->paginate);
    			break;
    			
    		case $tab =="created":
    			$orders = orders::where('status','=','1')->latest()->paginate($this->paginate);
    			break;
    		case $tab =="printed":
    			$orders = orders::where('status','=','2')->latest()->paginate($this->paginate);
    			break;
    		case $tab == "cooked":
    			$orders = orders::where('status','=','3')->latest()->paginate($this->paginate);
    			break;
    		case $tab == "finished":
    			$orders = orders::where('status','=','4')->latest()->paginate($this->paginate);
    			break;
    		case $tab =="cash":
    			$orders = orders::where('paymentmethod_id','=','1')->latest()->paginate($this->paginate);
    			break;
    		case $tab == "cancel":
    			$orders = orders::where('status','>=','5')->latest()->paginate($this->paginate);
    			break;
    			
    		default:
    			$orders = orders::latest()->paginate($this->paginate); 
    			break;
    	}
    	
    	return view('backend.pages.order.index')
    	->withOrders($orders)
    	->withTab($tab);
    	
    }
    
    /*
     * show the event of order printer.
     */
    
    public function orderprinter(){
    	$orders = orders::where('status','<','2')->count();
//     	return $orders;
    	foreach ($orders as $order){
//     		$order['shiptime'] = $order;
//     		event(new OrderPrinter($order));
    		$this->feieprinter($order);
    	}
    }
    
    /**
     * 
     * @return boolean
     */
    public function printmark(Request $request){
    	
    	$this->validate($request, [
    			'orderid' => 'required|numeric',
    	]);
    	$order = orders::where('id',$request->input('orderid'))->first();
    	
    	return true;
    }
    
    public function printreceipt(Request $request){
    	$this->validate($request, [
    			'id' => 'required|numeric',
    	]);
    	
    	$order = orders::where('id',$request->input('id'))->first();
    	
    	//feie printer
    	$result = [];
    	if ($this->feieprinter($order)) {
    		$result['msg']="success";
    	}else{
    		$result['msg']="Print fail";
    	}
    	return $result;
//     	$result = [];
//     	$result['shiptime'] = $order->shiptimeformat();
//     	$result['order'] = $order;
//     	$result['dishes'] = $order->dishes;
//     	if($order->address()->count()){
//     		$result['address'] = $order->address;
//     	}
//     	return $result;
    }
    
    protected function feieprinter(orders $order){
    
    	$printer = new Printer;
    
    	return $printer->print_order($order,$this->shop);

//     	return $printer->queryPrinterStatus("716500460");
    }
    
    /**
     * print the order and update the static of the order
     *
     * @return \Illuminate\Http\Response
     */
    public function printorder(Request $request)
    {	
    	$this->validate($request, [
    			'orderid' => 'required|numeric',
    	]);
    	$order = orders::where('id',$request->input('orderid'))->first();
    	
    	if($order->status!=1){
    		return response()->json([
    				'message'=>'Error, Order ID: '.$order->id.' This order has been print'
    		]);
    		
    	}else{
    		$order->update(['status'=>'2']);
    		return response()->json([
    				'message'=> 'success'
    		]);
    	}
    	
    }
    
    
    /**
     * update the static of the order to cook
     *
     * @return \Illuminate\Http\Response
     */
    public function cook(Request $request)
    {
    	$this->validate($request, [
    			'orderid' => 'required|numeric',
    	]);
    	$order = orders::where('id',$request->input('orderid'))->first();
    	 
    	if($order->status!=2){
    		if($order->status==1){
    			return response()->json([
    					'message'=>'Error, Order ID: '.$order->id.' This order has not printed'
    			]);
    		}
    		return response()->json([
    				'message'=>'Error, Order ID: '.$order->id.' This order has been cook'
    		]);
    
    	}else{
    		$order->update(['status'=>'3']);
    		return response()->json([
    				'message'=>'success'
    		]);
    	}
    	 
    }
    
    /**
     * update the static of the order to finish
     *
     * @return \Illuminate\Http\Response
     */
    public function finish(Request $request)
    {
    	$this->validate($request, [
    			'orderid' => 'required|numeric',
    	]);
    	$order = orders::where('id',$request->input('orderid'))->first();
    
    	if($order->status!=3){
    		if($order->status==1){
    			return response()->json([
    					'message'=>'Error, Order ID: '.$order->id.' This order has not printed'
    			]);
    		}
    	if($order->status==2){
    			return response()->json([
    					'message'=>'Error, Order ID: '.$order->id.' This order has not cooked'
    			]);
    		}
    		return response()->json([
    				'message'=>'Error, Order ID: '.$order->id.' This order has been finish'
    		]);
    
    	}else{
    		$order->update(['status'=>'4']);
    		$dt = Carbon::now();
    		$points = 0;
    		if($this->shop->coupon&&$this->shop->email_coupon){
    			if(!$order->coupon()->count()){//this order not use coupon  Finished status update fail, PLease do that again
    				
    				$coupon = Coupons::where('email', '=', $order->email)->latest()->first();
    				if($coupon){
    					$paymenttime = $coupon->created_at;
    				}else{
    					$paymenttime = $dt->startOfYear();
    				}
    				
    				$orders = orders::where('email','=',$order->email)
    				->Where('paymenttime', '>', $paymenttime)
    				->Where('status', '=', '4')->get();
    				
//     				return response()->json([
//     						'message'=>$paymenttime
//     				]);
    					
    				foreach($orders as $order){
    					$points += $order->totaldue;
    				}
    				
//     				return response()->json([
//     						'message'=>$orders
//     				]);
    				if($points >= $this->shop->coupon_condition){//send user a coupon
    					
    					do{
    						$code = str_random(6);
    					}while(Coupons::where('code', $code)->count());
    					
    					$expired_time =  Carbon::now()->addYear()->addDay()->toDateString();
    					
    					$photo_path = $this->makecode($this->path,$code,$expired_time,$this->shop->coupon_value);
    					
    					$coupon = Coupons::create([
    							'title' => 'Noodle Canteen Taradale Coupon',
    							'email'=>$order->email,
    							'value'=>$this->shop->coupon_value,
    							'used'=>0,
    							'code'=>$code,
    							'expired_time'=>$expired_time,
    							'photo_path'=>$photo_path
    					]);
    					
    					Mail::queue('emails.coupon.order_coupon',compact('coupon','order'),function ($message)use($coupon){
    						$message->from(env('MAIL_USERNAME'))->to($coupon->email)
    						->subject('Noodle Canteen Taradale Coupon');
    					});
    				}
    				
    			}
    			
    			//$order->coupon()->count()
    		}
    		return response()->json([
    				'message'=>'success'
    		]);
    		
    	}
    
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
//     	$orders = orders::where('status','<','2');
    	$order= orders::where('ordernumber', $id)->firstOrFail();
//         return $order;

//     	return $order->address()->count();

    	if($order->address()->count()){
    		$origin= urlencode($this->shop->address);
    		 
    		$destination= urlencode($order->address->address." ".$order->address->suburb." ".$order->address->city);
    		$url = "https://maps.googleapis.com/maps/api/directions/json?origin=".$origin."&destination=".$destination."&key=".$this->shop->googleapi;
    		$json = json_decode(file_get_contents($url), true);
    		 
    		Mapper::map($json['routes'][0]['legs'][0]['end_location']['lat'],$json['routes'][0]['legs'][0]['end_location']['lng'],['zoom' => 16]);
    	}
    	
//     	dd($order->coupon->count());
    	
        return view('backend.pages.order.showorder')
        ->withOrder($order)
        ->withShop($this->shop);
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
     * Remove the specified order from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//     	event(new DashboardOrder());
    	
//     	event(new OrderReceipt());
// return $id;
    	orders::destroy($id);
    	return redirect()->route('admin.order.index')->withFlashSuccess(trans("menu_backend.menu_order_deleting"));
//     	return "DESTORY";
    }
    
    
    /**
     * Search the specified order from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
    	
    	$tab= "all";
    	
    	$name = $request->input('table_search');
    	$orders = orders::where('name', 'LIKE', '%'.$name.'%')->paginate(10);
    	
    	return view('backend.pages.order.index')
    	->withOrders($orders)
    	->withTab($tab);
    }
    
    public function makecode($path,$code,$date,$value){
    	$img = Image::make(public_path($path));
    	$img->text($code, 58, 202, function($font){
    		$font->file(public_path('css/fonts/Roboto-Bold.ttf'));
    		$font->size(13);
    		$font->color('#e1e1e1');
    	});
    
    		$img->text($date, 215, 200, function($font){
    			$font->file(public_path('css/fonts/Roboto-Bold.ttf'));
    			$font->size(13);
    			$font->color('#e1e1e1');
    		});
    
    			$x = 276;//below 10 is 300 over is 268
    			if($value<10){
    				$x = 288;
    			}
    			if(preg_match('^[1-9]\d*\.\d*|0\.\d*[1-9]\d*$^',$value)){
    				$x = 268;
    			}
    			$img->text('$'.$value, $x, 135, function($font){
    				$font->file(public_path('css/fonts/Roboto-Bold.ttf'));
    				$font->size(42);
    				$font->color('#e0191c');
    			});
    
    				$img->save(public_path('images/coupon/'.$code.'.jpg'));
    				return 'images/coupon/'.$code.'.jpg';
    }
}
