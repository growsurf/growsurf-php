<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

enum FraudRiskLevel: string
{
    case LOW = 'LOW';

    case MEDIUM = 'MEDIUM';

    case HIGH = 'HIGH';
}
