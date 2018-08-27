<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Order\orders;
use Carbon\Carbon;
use App\Models\Shop\Shops;
use App\Models\Shop\Coupons;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;

class HandleOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'handle:order';
    protected $path = 'images/voucher.jpg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage orders to finishi, send coupons';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->shop = Shops::firstOrFail();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	//record the orders detail to log.
    	$total = [];
    	$total['orders'] = 0;
    	$total['deal'] = 0;
    	$total['meals'] = 0;
    	$total['delivery'] = 0;
    	$total['deliveryfee'] = 0;
    	$total['pickup'] = 0;
    	
    	$orders = Orders::where('status','2')->orderBy('id')->get();
    	$i=0;
    	foreach($orders as $order){
    		$order->update(['status'=>'3']);
    		$i++;
    	}
    	$j=0;
    	$orders = Orders::where('status','3')->orderBy('id')->get();
    	foreach($orders as $order){
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
    				
    				foreach($orders as $order){
    					$points += $order->totaldue;
    				}
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
    			
    		}
    		
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
    		$j++;
    	}
    	$total['orders'] = $orders->count();
    	
    	//     	$i=1;
    	Log::info(\Carbon\Carbon::now().' orders ammount: '.$i.' is cook, '.$j.' is finish. Total orders is '.$total['orders'].', Total deal is $'.$total['deal'].', Total melas is '.$total['meals'].', Total Delivery is '.$total['delivery'].', Total Delivery Fee is $'.$total['deliveryfee'].', Total Pick up is '.$total['pickup']);
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
