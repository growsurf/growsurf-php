<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantRefundTransactionResponse;

enum AmendmentType: string
{
    case REFUND = 'REFUND';

    case CHARGEBACK = 'CHARGEBACK';
}
