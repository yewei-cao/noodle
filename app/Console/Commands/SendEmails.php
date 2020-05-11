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
    	//find out the email which of receipt have not sent to customer
    	$orders = Orders::where('sendemail','0')
    				->where('created_at', '>',Carbon::today())
    				->orderBy('id')->get();
    	
    	foreach($orders as $order){
//     		$url = url();
    		//send receipt to customer
    		Mail::queue ( 'emails.order.receipt', compact ( 'order',''), function ($message) use ($order) 
    		{
    			$message->from ( env ( 'MAIL_FROM' ) )->to ( $order->email )->subject ( 'Noodle Canteen Receipt' );
    		});
    		
    		//check email is send or not
    		if(count(Mail::failures()) > 0){
    			Log::info('Email:'.$order->email.' is fail to send');
    		}else{
    			$order->update(['sendemail'=>'1']);
    			Log::info(\Carbon\Carbon::now().' email: '.$order->email.' Nub: '.$order->ordernumber.' is sent. ');
    		}

    	}
    	
    	
    
    }
    
    
    
  
    
    
}
