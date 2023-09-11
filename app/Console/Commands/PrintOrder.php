<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order\orders;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Prints\Printer;

class PrintOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'print:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To check and print out the missing orders';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	
    	$orders = Orders::where('status','1')
    				->where()->orderBy('id')->get();
    	
    	//feieprinter missing $shop 
    	if(!$this->feieprinter($order)){
    		//send me a email.
    		$num = orders::where('status','<','2')->count();
    		Mail::queue('emails.order.printfail',compact('num','order'),function ($message)use($order){
    			$message->from(env('MAIL_USERNAME'))->to($order->email)
    			->subject('Noodle Print Errors');
    		});
    	}
    	
        //$this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
    }

}
