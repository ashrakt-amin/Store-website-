<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderCreated;
use App\Mail\NewOrderMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order =$event->order ;
        $user =User::where('type','super_admin')->get();
        if(!$user){
            return ;
        }
        Mail::to($user)->send(new NewOrderMessage($order));
    }
}
