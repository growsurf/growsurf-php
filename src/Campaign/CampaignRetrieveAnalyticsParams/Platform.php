<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignRetrieveAnalyticsParams;

/** Platform filter for participant engagement analytics. */
enum Platform: string
{
    case ALL = 'ALL';

    case WEB = 'WEB';

    case IOS = 'IOS';

    case ANDROID = 'ANDROID';
}
