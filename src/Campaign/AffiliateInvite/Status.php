<?php

declare(strict_types=1);

namespace Growsurf\Campaign\AffiliateInvite;

/**
 * The invite's lifecycle state. Accepting a pending invite enrolls the invitee as an approved affiliate.
 */
enum Status: string
{
    case PENDING = 'PENDING';

    case ACCEPTED = 'ACCEPTED';

    case EXPIRED = 'EXPIRED';

    case REVOKED = 'REVOKED';
}
