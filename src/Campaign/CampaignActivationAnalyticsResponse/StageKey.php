<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

enum StageKey: string
{
    case ELIGIBLE = 'ELIGIBLE';

    case PORTAL_VIEWED = 'PORTAL_VIEWED';

    case SHARE_ACTION = 'SHARE_ACTION';

    case UNIQUE_REFERRAL_VISIT = 'UNIQUE_REFERRAL_VISIT';

    case LEAD = 'LEAD';

    case CREDITED_REFERRAL = 'CREDITED_REFERRAL';
}
