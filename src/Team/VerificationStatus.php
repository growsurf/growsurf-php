<?php

declare(strict_types=1);

namespace Growsurf\Team;

/**
 * GrowSurf team verification state. `VERIFIED` is required before a program can send participant emails.
 */
enum VerificationStatus: string
{
    case NOT_REQUESTED = 'NOT_REQUESTED';

    case REQUESTED = 'REQUESTED';

    case VERIFIED = 'VERIFIED';
}
