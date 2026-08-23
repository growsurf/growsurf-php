<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

enum ReferralSource: string
{
    case DIRECT = 'DIRECT';

    case PARTICIPANT = 'PARTICIPANT';

    case DELETED_PARTICIPANT = 'DELETED_PARTICIPANT';

    case IMPORT = 'IMPORT';

    case MANUAL = 'MANUAL';
}
