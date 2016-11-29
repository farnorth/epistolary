<?php

namespace Pilaster\Epistolary\Services;

interface NewsletterStats
{
    /**
     * Get event stats for tag.
     *
     * @param string $tag
     * @param array $events
     * @return array
     */
    function eventTotalsForTag($tag, $events);
}
