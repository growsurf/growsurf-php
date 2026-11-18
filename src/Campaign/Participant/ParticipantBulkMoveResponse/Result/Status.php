<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantBulkMoveResponse\Result;

/**
 * Per-row outcome. `MOVED` — the participant was resolved and is now in the target group. `NOT_FOUND` — no participant matches the ID or email. `DUPLICATE` — the entry resolves to the same participant as an earlier entry in the same request. `ERROR` — the lookup failed for this row.
 */
enum Status: string
{
    case MOVED = 'MOVED';

    case NOT_FOUND = 'NOT_FOUND';

    case DUPLICATE = 'DUPLICATE';

    case ERROR = 'ERROR';
}
