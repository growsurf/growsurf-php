<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantRecordTransactionParams;

/**
 * Connected payment provider.
 */
enum PaymentProvider: string
{
    case STRIPE = 'stripe';

    case CHARGEBEE = 'chargebee';

    case RECURLY = 'recurly';
}
