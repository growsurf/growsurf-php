<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Campaign;

enum Status: string
{
    case DRAFT = 'DRAFT';

    case PENDING = 'PENDING';

    case IN_PROGRESS = 'IN_PROGRESS';

    case COMPLETE = 'COMPLETE';

    case CANCELLED = 'CANCELLED';

    case DELETED = 'DELETED';
}
