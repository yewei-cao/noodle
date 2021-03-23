<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Order\Orders;

class Order_Process extends Event implements ShouldBroadcast
{

	use SerializesModels;

    public $printed;
    
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->printed= orders::where('status','=','2')->get();
// 		$this->created = Orders::where('status','=','1')->count();
// 	    $this->printed = Orders::where('status','=','2')->count();
// 	    $this->cooked = Orders::where('status','=','3')->count();
// 	    $this->finished = Orders::where('status','=','4')->count();
	}
	
	/**
	 * Get the channels the event should be broadcast on.
	 *
	 * @return array
	 */
	public function broadcastOn()
	{
		return ['order_process-channel'];
	}
}

