<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CommissionStructure;

/** The event that generates an affiliate commission. */
enum Event: string
{
    case CLICK = 'CLICK';

    case LEAD = 'LEAD';

    case SALE = 'SALE';
}
