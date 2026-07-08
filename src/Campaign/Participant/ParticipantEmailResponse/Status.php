<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantEmailResponse;

/**
 * The email was accepted for delivery.
 */
enum Status: string
{
    case QUEUED = 'queued';
}
