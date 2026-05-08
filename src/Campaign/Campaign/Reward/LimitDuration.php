<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Campaign\Reward;

enum LimitDuration: string
{
    case IN_TOTAL = 'IN_TOTAL';

    case PER_MONTH = 'PER_MONTH';
}
