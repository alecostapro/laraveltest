<?php

namespace App\Listeners;

use App\Models\Contract;
use App\Events\ContractCreated;

class ContractcreatedListener
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
    public function handle(ContractCreated $event)
    {
        Contract::create([
            'customer_id' => $event->order->customer_id,
            'order_id' => $event->order->id
        ]);
    }
}
