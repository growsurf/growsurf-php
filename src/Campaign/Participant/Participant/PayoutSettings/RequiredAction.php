<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\Participant\PayoutSettings;

enum RequiredAction: string
{
    case PAYOUT_DESTINATION = 'PAYOUT_DESTINATION';

    case TAX_INFO = 'TAX_INFO';
}
