<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantRefundTransactionParams\AmendmentType;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * **Affiliate programs only.** Records an amendment (refund, partial refund, refund cancellation, or chargeback) against a previously recorded transaction and reverses or adjusts the referrer's commission. The inverse of Record Affiliate Transaction. Identify the original transaction with the same identifier(s) you sent when recording it. Commissions already paid out to the affiliate are not clawed back; the amendment is recorded for tax reporting only.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::refundTransaction()
 *
 * @phpstan-type ParticipantRefundTransactionParamsShape = array{
 *   id: string,
 *   amendmentType?: null|AmendmentType|value-of<AmendmentType>,
 *   amount?: int|null,
 *   amountRefunded?: int|null,
 *   chargeID?: string|null,
 *   currency?: string|null,
 *   description?: string|null,
 *   externalID?: string|null,
 *   invoiceID?: string|null,
 *   orderID?: string|null,
 *   paymentID?: string|null,
 *   paymentIntentID?: string|null,
 *   refundAmount?: int|null,
 *   refundID?: string|null,
 *   refundStatus?: string|null,
 *   transactionID?: string|null,
 * }
 */
final class ParticipantRefundTransactionParams implements BaseModel
{
    /** @use SdkModel<ParticipantRefundTransactionParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * REFUND covers full refunds, partial refunds, and refund cancellations; CHARGEBACK is always a full reversal.
     *
     * @var value-of<AmendmentType>|null $amendmentType
     */
    #[Optional(enum: AmendmentType::class)]
    public ?string $amendmentType;

    /**
     * Original sale gross (minor units). Optional — the value stored when the transaction was recorded is used when available; only needed for partial refunds of older records.
     */
    #[Optional]
    public ?int $amount;

    /**
     * Cumulative amount refunded so far, in the currency's minor unit. Omit for a full refund. For a partial refund send the running total, not the per-refund delta.
     */
    #[Optional]
    public ?int $amountRefunded;

    #[Optional('chargeId')]
    public ?string $chargeID;

    /**
     * 3-letter ISO currency. Optional — resolved from the original commission when available.
     */
    #[Optional]
    public ?string $currency;

    #[Optional]
    public ?string $description;

    #[Optional('externalId')]
    public ?string $externalID;

    #[Optional('invoiceId')]
    public ?string $invoiceID;

    #[Optional('orderId')]
    public ?string $orderID;

    #[Optional('paymentId')]
    public ?string $paymentID;

    #[Optional('paymentIntentId')]
    public ?string $paymentIntentID;

    /**
     * The per-refund delta (minor units). Optional bookkeeping field.
     */
    #[Optional]
    public ?int $refundAmount;

    /**
     * Stable per-refund identifier. Recommended for partial refunds so repeated calls stay idempotent.
     */
    #[Optional('refundId')]
    public ?string $refundID;

    /**
     * Refund status. Send "canceled" with a lowered amountRefunded to restore a previously reduced commission.
     */
    #[Optional]
    public ?string $refundStatus;

    #[Optional('transactionId')]
    public ?string $transactionID;

    /**
     * `new ParticipantRefundTransactionParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantRefundTransactionParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantRefundTransactionParams)->withID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AmendmentType|value-of<AmendmentType>|null $amendmentType
     */
    public static function with(
        string $id,
        AmendmentType|string|null $amendmentType = null,
        ?int $amount = null,
        ?int $amountRefunded = null,
        ?string $chargeID = null,
        ?string $currency = null,
        ?string $description = null,
        ?string $externalID = null,
        ?string $invoiceID = null,
        ?string $orderID = null,
        ?string $paymentID = null,
        ?string $paymentIntentID = null,
        ?int $refundAmount = null,
        ?string $refundID = null,
        ?string $refundStatus = null,
        ?string $transactionID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $amendmentType && $self['amendmentType'] = $amendmentType;
        null !== $amount && $self['amount'] = $amount;
        null !== $amountRefunded && $self['amountRefunded'] = $amountRefunded;
        null !== $chargeID && $self['chargeID'] = $chargeID;
        null !== $currency && $self['currency'] = $currency;
        null !== $description && $self['description'] = $description;
        null !== $externalID && $self['externalID'] = $externalID;
        null !== $invoiceID && $self['invoiceID'] = $invoiceID;
        null !== $orderID && $self['orderID'] = $orderID;
        null !== $paymentID && $self['paymentID'] = $paymentID;
        null !== $paymentIntentID && $self['paymentIntentID'] = $paymentIntentID;
        null !== $refundAmount && $self['refundAmount'] = $refundAmount;
        null !== $refundID && $self['refundID'] = $refundID;
        null !== $refundStatus && $self['refundStatus'] = $refundStatus;
        null !== $transactionID && $self['transactionID'] = $transactionID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * REFUND covers full refunds, partial refunds, and refund cancellations; CHARGEBACK is always a full reversal.
     *
     * @param AmendmentType|value-of<AmendmentType> $amendmentType
     */
    public function withAmendmentType(AmendmentType|string $amendmentType): self
    {
        $self = clone $this;
        $self['amendmentType'] = $amendmentType;

        return $self;
    }

    /**
     * Original sale gross (minor units). Optional — the value stored when the transaction was recorded is used when available; only needed for partial refunds of older records.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Cumulative amount refunded so far, in the currency's minor unit. Omit for a full refund. For a partial refund send the running total, not the per-refund delta.
     */
    public function withAmountRefunded(int $amountRefunded): self
    {
        $self = clone $this;
        $self['amountRefunded'] = $amountRefunded;

        return $self;
    }

    public function withChargeID(string $chargeID): self
    {
        $self = clone $this;
        $self['chargeID'] = $chargeID;

        return $self;
    }

    /**
     * 3-letter ISO currency. Optional — resolved from the original commission when available.
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    public function withInvoiceID(string $invoiceID): self
    {
        $self = clone $this;
        $self['invoiceID'] = $invoiceID;

        return $self;
    }

    public function withOrderID(string $orderID): self
    {
        $self = clone $this;
        $self['orderID'] = $orderID;

        return $self;
    }

    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    public function withPaymentIntentID(string $paymentIntentID): self
    {
        $self = clone $this;
        $self['paymentIntentID'] = $paymentIntentID;

        return $self;
    }

    /**
     * The per-refund delta (minor units). Optional bookkeeping field.
     */
    public function withRefundAmount(int $refundAmount): self
    {
        $self = clone $this;
        $self['refundAmount'] = $refundAmount;

        return $self;
    }

    /**
     * Stable per-refund identifier. Recommended for partial refunds so repeated calls stay idempotent.
     */
    public function withRefundID(string $refundID): self
    {
        $self = clone $this;
        $self['refundID'] = $refundID;

        return $self;
    }

    /**
     * Refund status. Send "canceled" with a lowered amountRefunded to restore a previously reduced commission.
     */
    public function withRefundStatus(string $refundStatus): self
    {
        $self = clone $this;
        $self['refundStatus'] = $refundStatus;

        return $self;
    }

    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}
