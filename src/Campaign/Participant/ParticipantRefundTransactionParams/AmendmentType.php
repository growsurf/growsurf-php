<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantRefundTransactionParams;

/**
 * REFUND covers full refunds, partial refunds, and refund cancellations; CHARGEBACK is always a full reversal. Defaults to REFUND.
 */
enum AmendmentType: string
{
    case REFUND = 'REFUND';

    case CHARGEBACK = 'CHARGEBACK';
}
