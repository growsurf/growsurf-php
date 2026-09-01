<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

enum PortalViewedLabel: string
{
    case REFERRAL = 'Referral portal viewed';

    case AFFILIATE = 'Affiliate portal viewed';
}
