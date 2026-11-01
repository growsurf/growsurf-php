<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantRefundTransactionParams;

/**
 * Connected payment provider.
 */
enum PaymentProvider: string
{
    case STRIPE = 'stripe';

    case CHARGEBEE = 'chargebee';

    case RECURLY = 'recurly';
}
