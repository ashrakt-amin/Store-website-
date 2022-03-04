<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcast
{

    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order =$order ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // PresenceChannel
        // PrivateChannel limit a person who has permission to listen on channel
        // PublicChannel

        return new PrivateChannel('orders');
    }

    public function broadcastAz()
    {
        // this func to use the event name alternative 'App\\Events\\OrderCreated' with channel
        return 'OrderCreated';
    }
}
