<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantReward;

/**
 * Where a participant reward's `amount` or `percentOff` comes from. `METADATA` means the amount saved when the reward was earned.
 */
enum AmountSource: string
{
    case STRIPE = 'STRIPE';

    case CHARGEBEE = 'CHARGEBEE';

    case RECURLY = 'RECURLY';

    case CHARGIFY = 'CHARGIFY';

    case PAYPAL = 'PAYPAL';

    case VENMO = 'VENMO';

    case TANGO_CARD = 'TANGO_CARD';

    case TREMENDOUS = 'TREMENDOUS';

    case XTRM = 'XTRM';

    case METADATA = 'METADATA';
}
