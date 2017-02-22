<?php

namespace Pilaster\Epistolary\Listeners;

class ListEventListener
{
    /**
     *
     * @param \Pilaster\Epistolary\Events\ListCreated $list
     */
    public function onListCreated($event)
    {
        $list = $event->list;
        $list->createInESP();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Pilaster\Epistolary\Events\ListCreated',
            'Pilaster\Epistolary\Listeners\ListEventListener@onListCreated'
        );
    }

}
