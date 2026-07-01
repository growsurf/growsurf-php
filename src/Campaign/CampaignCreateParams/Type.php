<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignCreateParams;

/**
 * The program type. Immutable after creation.
 */
enum Type: string
{
    case REFERRAL = 'REFERRAL';

    case AFFILIATE = 'AFFILIATE';
}
