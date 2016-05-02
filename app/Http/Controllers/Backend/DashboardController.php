<?php 
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order\Orders;
use App\Events\DashboardOrder;
use App\Events\OrderReceipt;

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
		
		$created = Orders::where('status','=','1')->count();
		
		$printed = Orders::where('status','=','2')->count();
		
// 		event(new DashboardOrderEvent(Orders::findOrFail(9)));
// 		event(new OrderReceipt());
		
// 		event(new OrderReceipt());
		
		return view('backend.pages.dashboard')
		->withCreated(Orders::where('status','=','1')->count())
		->withPrinted(Orders::where('status','=','2')->count())
		->withCooked(Orders::where('status','=','3')->count())
		->withFinished(Orders::where('status','=','4')->count());
		
		
		
	}
}