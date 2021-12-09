<?php

namespace App\Listeners;

use App\Events\OrderDeleted;

class OrderdeletedListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(OrderDeleted $event)
    {
        $event->order->contract->delete();
    }
}
