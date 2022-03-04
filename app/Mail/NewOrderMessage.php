<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderMessage extends Mailable
{

    use Queueable, SerializesModels;
    protected $order ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    

    public function __construct($order)
    {
        $this->order = $order ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('New Order');
        $this->from('order@store.local','Store App');
        return $this->view('emails.newOrder',[
            'name'=> 'admin',
            'order'=>$this->order 
        ])->text('emails.text.newOrder');
    }
}
