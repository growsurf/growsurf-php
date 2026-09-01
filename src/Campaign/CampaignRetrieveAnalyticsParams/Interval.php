<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignRetrieveAnalyticsParams;

/**
 * When set to `day`, `week`, or `month`, the response also includes a `series` array with per-period totals and uses the same bucket size for `engagement.series`. Defaults to `total` (no legacy series); `engagement.series` uses daily buckets when `interval` is `total` or omitted.
 */
enum Interval: string
{
    case DAY = 'day';

    case WEEK = 'week';

    case MONTH = 'month';

    case TOTAL = 'total';
}
