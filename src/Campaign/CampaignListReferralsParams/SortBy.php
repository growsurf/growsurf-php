<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignListReferralsParams;

/**
 * Field used to sort referral results.
 */
enum SortBy: string
{
    case UPDATED_AT = 'updatedAt';

    case CREATED_AT = 'createdAt';

    case EMAIL = 'email';

    case REFERRAL_TRIGGERED_AT = 'referralTriggeredAt';
}
