<?php

namespace App\Mail;

use App\Enums\Shop\ProductType;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Order
     */
    public $order;

    /**
     * OrderShipped constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $products = $this->order->products();
        $user = $this->order->user;

        return $this->view('emails.orders.shipped', [
            'products' => $products,
            'user' => $user,
        ]);
    }
}
