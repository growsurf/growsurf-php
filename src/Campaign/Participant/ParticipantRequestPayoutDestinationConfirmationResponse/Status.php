<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantRequestPayoutDestinationConfirmationResponse;

/**
 * Confirms the message was requested.
 */
enum Status: string
{
    case CONFIRMATION_REQUESTED = 'CONFIRMATION_REQUESTED';
}
