<?php

namespace Pilaster\Epistolary\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Pilaster\Epistolary\MailingList;

class CampaignSent extends Event
{
    use SerializesModels;

    public $list;

    /**
     * Create a new event instance.
     *
     * @param \Pilaster\Epistolary\MailingList $list
     */
    public function __construct(MailingList $list)
    {
        $this->list = $list;
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
