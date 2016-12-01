<?php

namespace Pilaster\Epistolary\Services;

use Mailgun\Mailgun;

class MailgunStats implements NewsletterStats
{
    /**
     * @var Mailgun
     */
    private $mailgun;

    /**
     * @var string
     */
    private $domain;

    /**
     * @param Mailgun $mailgun
     */
    function __construct(Mailgun $mailgun)
    {
        $this->mailgun = $mailgun;
        $this->domain = config('services.mailgun.domain');
    }

    /**
     * @param string $tag
     * @param array $events
     * @return array
     */
    function eventTotalsForTag($tag, $events = ['opened', 'clicked'])
    {
        $events = (array) $events;

        try {
            $result = $this->mailgun->get("{$this->domain}/tags/{$tag}/stats", [
                'event' => $events,
                'resolution' => 'month',
                'limit' => 300,
            ]);
            $stats = $result->http_response_body->stats;
        } catch (\Exception $e) {
            $stats = array_fill(0, count($events), (object) array_fill_keys($events, (object) ['total' => 0]));
        }

        $totals = [];

        foreach ($events as $event) {
            $totals[$event] = array_reduce($stats, function ($total, $stats) use ($event) {
                return $total + $stats->{$event}->total;
            }, 0);
        }

        return $totals;
    }
}
