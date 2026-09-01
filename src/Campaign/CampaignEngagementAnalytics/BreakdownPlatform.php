<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

enum BreakdownPlatform: string
{
    case WEB = 'WEB';

    case IOS = 'IOS';

    case ANDROID = 'ANDROID';
}
