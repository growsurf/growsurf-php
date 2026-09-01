<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

enum StalledSegmentKey: string
{
    case ELIGIBLE_NO_PORTAL_VIEW = 'ELIGIBLE_NO_PORTAL_VIEW';

    case PORTAL_VIEWED_NO_SHARE_ACTION = 'PORTAL_VIEWED_NO_SHARE_ACTION';

    case SHARED_NO_UNIQUE_REFERRAL_VISIT = 'SHARED_NO_UNIQUE_REFERRAL_VISIT';

    case UNIQUE_VISIT_NO_LEAD = 'UNIQUE_VISIT_NO_LEAD';

    case LEAD_NO_CREDITED_REFERRAL = 'LEAD_NO_CREDITED_REFERRAL';
}
