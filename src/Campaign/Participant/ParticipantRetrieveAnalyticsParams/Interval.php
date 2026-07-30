<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantRetrieveAnalyticsParams;

/**
 * Bucket size for the `series` (only used when `include` contains `series`). Defaults to `day`.
 */
enum Interval: string
{
    case DAY = 'day';

    case WEEK = 'week';

    case MONTH = 'month';
}
