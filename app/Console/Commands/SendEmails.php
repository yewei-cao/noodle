<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Order\orders;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Receipt to Customers';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//     	$orders = orders::where('email','=','yeweicao@gmail.com')
//     	    	->Where('paymenttime', '>', '2016-01-01 00:00:00')
//     	    	->Where('status', '=', '4')->get();
    	
    	$orders = Orders::where('sendemail','0')
    				->where('created_at', '>',Carbon::today())
    				->orderBy('id')->get();
    	
    				
//     	$coupon_count = Coupons::where('used_time', '>', Carbon::today())
// 	    		->Where('used_time', '<', Carbon::tomorrow())
// 	    		->Where('used','=',1)
// 	    		->count();
    	foreach($orders as $order){
    		
    		Mail::queue ( 'emails.order.receipt', compact ( 'order' ), function ($message) use ($order) {
    						$message->from ( env ( 'MAIL_FROM' ) )->to ( $order->email )->subject ( 'Noodle Canteen Receipt' );
    					} );
    		$order->update(['sendemail'=>'1']);
    	}
    	
    	//     	$i=1;
//     	Log::info(\Carbon\Carbon::now().' orders ammount: '.$i.' is cook, '.$j.' is finish. Total orders is '.$total['orders'].', Total deal is $'.$total['deal'].', Total melas is '.$total['meals'].', Total Delivery is '.$total['delivery'].', Total Delivery Fee is $'.$total['deliveryfee'].', Total Pick up is '.$total['pickup']);
    	Log::info(\Carbon\Carbon::now().' email:'.$order->email.' is sent. ');
    
    }
    
    
    
  
    
    
}
