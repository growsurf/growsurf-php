<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantRequestPayoutDestinationConfirmationParams;

/**
 * The payout provider the participant should confirm a destination for.
 */
enum Provider: string
{
    case PAYPAL = 'PAYPAL';

    case WISECOM = 'WISECOM';
}
