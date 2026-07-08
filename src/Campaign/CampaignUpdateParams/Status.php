<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignUpdateParams;

/**
 * The requested program status. `IN_PROGRESS` publishes or resumes the program; `COMPLETE` ends it. Any other value returns a `400`.
 */
enum Status: string
{
    case IN_PROGRESS = 'IN_PROGRESS';

    case COMPLETE = 'COMPLETE';
}
