<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignRetrieveAnalyticsParams;

/**
 * When set to `day`, `week`, or `month`, the response also includes a `series` array with per-period totals. Defaults to `total` (no series).
 */
enum Interval: string
{
    case DAY = 'day';

    case WEEK = 'week';

    case MONTH = 'month';

    case TOTAL = 'total';
}
