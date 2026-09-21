<?php

declare(strict_types=1);

namespace Growsurf\Campaign\ReferralFlowScreenshot;

/**
 * Which side of the referral flow the image shows.
 */
enum View: string
{
    case REFERRER = 'referrer';

    case REFERRED_FRIEND = 'referredFriend';
}
