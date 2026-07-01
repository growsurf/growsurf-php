<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Reward;

/**
 * Whether the reward can be earned in total, on a monthly basis, or on a yearly basis.
 */
enum LimitDuration: string
{
    case IN_TOTAL = 'IN_TOTAL';

    case PER_MONTH = 'PER_MONTH';

    case PER_YEAR = 'PER_YEAR';
}
