<?php

declare(strict_types=1);

namespace Growsurf\Campaign\AffiliateApplication;

/**
 * GrowSurf risk assessment. Applications that are not `LOW` risk are held for manual review.
 */
enum RiskLevel: string
{
    case LOW = 'LOW';

    case MEDIUM = 'MEDIUM';

    case HIGH = 'HIGH';
}
