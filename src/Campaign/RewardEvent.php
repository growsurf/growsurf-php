<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/** The referral event that earns a Campaign Reward. */
enum RewardEvent: string
{
    case LEAD = 'LEAD';

    case CONVERSION = 'CONVERSION';
}
