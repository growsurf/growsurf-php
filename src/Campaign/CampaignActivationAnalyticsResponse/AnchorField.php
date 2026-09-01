<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

enum AnchorField: string
{
    case ENROLLED_AS_ADVOCATE_AT = 'enrolledAsAdvocateAt';

    case APPROVED_AS_AFFILIATE_AT = 'approvedAsAffiliateAt';
}
