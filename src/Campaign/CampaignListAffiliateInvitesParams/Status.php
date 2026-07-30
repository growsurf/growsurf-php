<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignListAffiliateInvitesParams;

/**
 * Only return invites with this status.
 */
enum Status: string
{
    case PENDING = 'PENDING';

    case ACCEPTED = 'ACCEPTED';

    case EXPIRED = 'EXPIRED';

    case REVOKED = 'REVOKED';
}
