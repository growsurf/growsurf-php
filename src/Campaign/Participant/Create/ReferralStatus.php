<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\Create;

enum ReferralStatus: string
{
    case CREDIT_PENDING = 'CREDIT_PENDING';

    case CREDIT_AWARDED = 'CREDIT_AWARDED';
}
