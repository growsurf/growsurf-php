<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

enum ReferralSource: string
{
    case DIRECT = 'DIRECT';

    case PARTICIPANT = 'PARTICIPANT';
}
