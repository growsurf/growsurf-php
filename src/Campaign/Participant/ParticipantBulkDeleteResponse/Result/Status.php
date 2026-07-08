<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantBulkDeleteResponse\Result;

/**
 * Per-row outcome. `DELETED` — the participant was resolved and removed. `NOT_FOUND` — no participant matches the ID or email. `DUPLICATE` — the entry resolves to the same participant as an earlier entry in the same request. `ERROR` — the lookup or deletion failed for this row.
 */
enum Status: string
{
    case DELETED = 'DELETED';

    case NOT_FOUND = 'NOT_FOUND';

    case DUPLICATE = 'DUPLICATE';

    case ERROR = 'ERROR';
}
