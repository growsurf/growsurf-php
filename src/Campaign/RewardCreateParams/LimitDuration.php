<?php

declare(strict_types=1);

namespace Growsurf\Campaign\RewardCreateParams;

/**
 * The window over which `limit` applies.
 */
enum LimitDuration: string
{
    case IN_TOTAL = 'IN_TOTAL';

    case PER_MONTH = 'PER_MONTH';

    case PER_YEAR = 'PER_YEAR';
}
