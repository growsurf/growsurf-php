<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantReward;

enum Status: string
{
    case PENDING = 'PENDING';

    case FULFILLED = 'FULFILLED';
}
