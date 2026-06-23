<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\Participant\PayoutSettings;

enum RequiredAction: string
{
    case PAYPAL_EMAIL = 'PAYPAL_EMAIL';

    case TAX_INFO = 'TAX_INFO';
}
