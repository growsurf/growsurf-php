<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse\ActivationStalledSegment;

enum ToStage: string
{
    case PORTAL_VIEWED = 'PORTAL_VIEWED';

    case SHARE_ACTION = 'SHARE_ACTION';

    case UNIQUE_REFERRAL_VISIT = 'UNIQUE_REFERRAL_VISIT';

    case LEAD = 'LEAD';

    case CREDITED_REFERRAL = 'CREDITED_REFERRAL';
}
