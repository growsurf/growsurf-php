<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse\Destination;

/**
 * The legal recipient type the participant confirmed, if any.
 */
enum LegalEntityType: string
{
    case INDIVIDUAL = 'INDIVIDUAL';

    case BUSINESS = 'BUSINESS';
}
