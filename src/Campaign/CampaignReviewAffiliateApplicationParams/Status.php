<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignReviewAffiliateApplicationParams;

/**
 * The decision. `APPROVED` enrolls the applicant as an affiliate; `DENIED` closes the application.
 */
enum Status: string
{
    case APPROVED = 'APPROVED';

    case DENIED = 'DENIED';
}
