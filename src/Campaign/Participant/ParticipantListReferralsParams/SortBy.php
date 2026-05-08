<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantListReferralsParams;

/**
 * Field used to sort referral results.
 */
enum SortBy: string
{
    case UPDATED_AT = 'updatedAt';

    case CREATED_AT = 'createdAt';

    case EMAIL = 'email';

    case FIRST_NAME = 'firstName';

    case LAST_NAME = 'lastName';

    case REFERRAL_STATUS = 'referralStatus';

    case REFERRAL_TRIGGERED_AT = 'referralTriggeredAt';
}
