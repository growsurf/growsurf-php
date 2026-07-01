<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignUpdateParams;

/**
 * The program status. Transitions are validated; DELETED is not allowed.
 */
enum Status: string
{
    case DRAFT = 'DRAFT';

    case PENDING = 'PENDING';

    case IN_PROGRESS = 'IN_PROGRESS';

    case COMPLETE = 'COMPLETE';

    case CANCELLED = 'CANCELLED';
}
