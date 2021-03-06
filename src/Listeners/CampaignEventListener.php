<?php

namespace Pilaster\Epistolary\Listeners;

class CampaignEventListener
{
    /**
     * Handle user login events.
     *
     * @param \Pilaster\Epistolary\Events\CampaignSent $event
     */
    public function onCampaignSent($event)
    {
        $campaign = $event->campaign;
        $campaign->markAsSent();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Pilaster\Epistolary\Events\CampaignSent',
            'Pilaster\Epistolary\Listeners\CampaignEventListener@onCampaignSent'
        );
    }

}
