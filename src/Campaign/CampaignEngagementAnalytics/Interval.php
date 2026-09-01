<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

enum Interval: string
{
    case DAY = 'day';

    case WEEK = 'week';

    case MONTH = 'month';
}
