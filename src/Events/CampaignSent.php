<?php

namespace Pilaster\Epistolary\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Pilaster\Epistolary\Campaign;

class CampaignSent extends Event
{
    use SerializesModels;

    public $campaign;

    /**
     * Create a new event instance.
     *
     * @param \Pilaster\Epistolary\Campaign $campaign
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
