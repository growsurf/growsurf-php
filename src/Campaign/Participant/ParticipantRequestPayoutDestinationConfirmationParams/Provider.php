<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantRequestPayoutDestinationConfirmationParams;

/**
 * The payout provider the participant should confirm a destination for. `VENMO` uses a confirmed email and is available only when connected PayPal Payouts and payout-email confirmation are enabled in a USD program. Venmo recipients must be in the United States.
 */
enum Provider: string
{
    case PAYPAL = 'PAYPAL';

    case VENMO = 'VENMO';

    case WISECOM = 'WISECOM';
}
