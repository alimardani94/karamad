<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;

class OrderEventSubscriber
{
    /**
     * @param $event
     */
    public function sendShipmentNotification($event) {

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(OrderShipped::class, [OrderEventSubscriber::class, 'sendShipmentNotification']);
    }
}
