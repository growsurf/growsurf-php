<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantUpdateParams;

enum AffiliateStatus: string
{
    case APPROVED = 'APPROVED';

    case SUSPENDED = 'SUSPENDED';

    case BANNED = 'BANNED';
}
