<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

enum PortalViewSource: string
{
    case DEFAULT_LAUNCHER = 'DEFAULT_LAUNCHER';

    case SDK_OPEN = 'SDK_OPEN';

    case CSS_CLASS = 'CSS_CLASS';

    case HOSTED_PORTAL = 'HOSTED_PORTAL';

    case NATIVE_WINDOW = 'NATIVE_WINDOW';

    case UNKNOWN = 'UNKNOWN';
}
