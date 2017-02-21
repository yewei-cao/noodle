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

class OrderController extends Controller
{
	protected $paginate = 10;
	
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
//     	event(new OrderPrinter('69'));
    	
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//     	event(new DashboardOrder());
    	
//     	event(new OrderReceipt());
    	orders::destroy($id);
    	return redirect()->route('admin.menu.order.index')->withFlashSuccess(trans("menu_backend.menu_dish_deleting"));
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
}
