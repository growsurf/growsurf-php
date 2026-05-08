<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantListPayoutsParams;

/**
 * Participant payout status.
 */
enum Status: string
{
    case UPCOMING = 'UPCOMING';

    case QUEUED = 'QUEUED';

    case ISSUED = 'ISSUED';

    case FAILED = 'FAILED';
}
