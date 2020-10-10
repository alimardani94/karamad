<?php

namespace App\Listeners;

use App\Mail\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderEventSubscriber
{
    /**
     * @param $event
     */
    public function sendShipmentNotification($event)
    {
        $order = $event->order;
        Mail::to($order->user)->send(new OrderShipped($order));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param Dispatcher $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\OrderShipped',
            'App\Listeners\OrderEventSubscriber@sendShipmentNotification'
        );
    }
}
