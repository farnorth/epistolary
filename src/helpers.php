<?php

namespace Pilaster\Epistolary;

/**
 * Return active class if the path matches url segment.
 *
 * @param string $path
 * @param string $active
 * @return string
 */
function set_active($path, $active = 'active')
{
    $segments = request()->segments();
    if (count($segments) < 2 || $segments[0] != 'newsletters' || $segments[1] != $path) {
        return '';
    }
    return $active;
}
