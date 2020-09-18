<?php

namespace App\Listeners;

use App\Events\InvoicePayed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;

class InvoiceEventSubscriber
{
    /**
     * @param $event
     */
    public function handleInvoicePayed($event) {

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(InvoicePayed::class, [InvoiceEventSubscriber::class, 'handleInvoicePayed']);
    }
}
