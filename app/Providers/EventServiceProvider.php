<?php

namespace App\Providers;

use App\Events\OrderDeleted;
use App\Events\ContractCreated;
use App\Events\CustomerDeleted;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\OrderdeletedListener;
use App\Listeners\ContractcreatedListener;
use App\Listeners\CustomerdeletedListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CustomerDeleted::class => [
            CustomerdeletedListener::class,
        ],
        ContractCreated::class => [
            ContractcreatedListener::class,
        ],
        OrderDeleted::class => [
            OrderdeletedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
