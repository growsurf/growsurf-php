<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignListAffiliateApplicationsParams;

/**
 * Only return applications with this status.
 */
enum Status: string
{
    case PENDING = 'PENDING';

    case APPROVED = 'APPROVED';

    case DENIED = 'DENIED';
}
