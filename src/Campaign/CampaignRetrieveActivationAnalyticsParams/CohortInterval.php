<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignRetrieveActivationAnalyticsParams;

enum CohortInterval: string
{
    case DAY = 'day';

    case WEEK = 'week';

    case MONTH = 'month';
}
