<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Order\Orders;
use App\Models\Menu\Dishes;
use Carbon\Carbon;

class OrderPrinter extends Event implements ShouldBroadcast
{
    use SerializesModels;
    
    public $order;
    public $dishes;
    public $address;
    public $shiptime;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Orders $order)
    {
    	//change shiptime format: Thursday 02:15:16 PM
    	$this->shiptime = $order->shiptimeformat();
        $this->order = $order;
        $this->dishes = $order->dishes;
        
        if($order->address()->count()){
        	$this->address = $order->address;
        }
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['order_printer-channel'];
    }
}
