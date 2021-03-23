<?php 
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order\orders;
use App\Events\DashboardOrder;
use App\Events\OrderReceipt;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller {

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
// 		event(new OrderReceipt(Orders::findOrFail(9)));
		
// 		$created = orders::where('status','=','1')->count();
// 		print_r($created);
		
		$printed_orders = orders::where('status','=','2')->get();
		
// 		event(new DashboardOrderEvent(Orders::findOrFail(9)));
// 		event(new OrderReceipt());
		
// 		event(new OrderReceipt());
		
		return view('backend.pages.dashboard')
		->withCreated(Orders::where('status','=','1')->count())
		->withPrinted(Orders::where('status','=','2')->count())
		->withCooked(Orders::where('status','=','3')->count())
		->withFinished(Orders::where('status','=','4')->count())
		->withPrinted_orders($printed_orders);
		
	}
	
	/*
	 * @return process data 
	 */
	
	public function orderprocess(Request $request){
		$this->validate($request, [
				'id' => 'required',
		]);
		$result = ['d','e'];
		return $result;
		
	}
}