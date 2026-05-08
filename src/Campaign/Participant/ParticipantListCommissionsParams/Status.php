<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantListCommissionsParams;

/**
 * Participant commission status.
 */
enum Status: string
{
    case PENDING = 'PENDING';

    case APPROVED = 'APPROVED';

    case PAID = 'PAID';

    case REVERSED = 'REVERSED';

    case DELETED = 'DELETED';
}
