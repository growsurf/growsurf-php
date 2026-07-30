<?php

declare(strict_types=1);

namespace Growsurf\Campaign\AffiliateApplication;

/**
 * Where the application is in review. Only `PENDING` applications can be decided.
 */
enum Status: string
{
    case PENDING = 'PENDING';

    case APPROVED = 'APPROVED';

    case DENIED = 'DENIED';
}
