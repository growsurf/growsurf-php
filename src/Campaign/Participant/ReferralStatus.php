<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

enum ReferralStatus: string
{
    case CREDIT_PENDING = 'CREDIT_PENDING';

    case CREDIT_AWARDED = 'CREDIT_AWARDED';

    case CREDIT_EXPIRED = 'CREDIT_EXPIRED';

    case INVITE_SENT = 'INVITE_SENT';
}
