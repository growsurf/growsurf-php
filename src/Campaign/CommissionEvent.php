<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/** The affiliate event that generated a commission. */
enum CommissionEvent: string
{
    case LEAD = 'LEAD';

    case SALE = 'SALE';
}
