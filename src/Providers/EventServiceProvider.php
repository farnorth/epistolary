<?php

namespace Pilaster\Epistolary\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //'Pilaster\Epistolary\Events\SomeEvent' => [
        //    'Pilaster\Epistolary\Listeners\EventListener',
        //],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        'Pilaster\Epistolary\Listeners\CampaignEventListener',
        'Pilaster\Epistolary\Listeners\ListEventListener',
    ];
}
