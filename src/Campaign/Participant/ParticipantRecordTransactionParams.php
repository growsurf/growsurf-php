<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;
use Growsurf\Core\Conversion\MapOf;

/**
 * **Affiliate programs only.** Records a sale made by a referred customer and generates affiliate commissions for their referrer when applicable. Requires at least one transaction identifier (externalId, transactionId, orderId, paymentId, invoiceId, paymentIntentId, or chargeId) so repeated requests can be de-duplicated — without one, a resent sale would create a second commission. Reuse the same identifier(s) when refunding.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::recordTransaction()
 *
 * @phpstan-type ParticipantRecordTransactionParamsShape = array{
 *   id: string,
 *   currency: string,
 *   grossAmount: int,
 *   amountCashNet?: int|null,
 *   amountPaid?: int|null,
 *   chargeID?: string|null,
 *   customerID?: string|null,
 *   description?: string|null,
 *   externalID?: string|null,
 *   invoiceID?: string|null,
 *   invoiceSubtotalExcludingTax?: int|null,
 *   invoiceTotal?: int|null,
 *   invoiceTotalExcludingTax?: int|null,
 *   netAmount?: int|null,
 *   orderID?: string|null,
 *   paidAt?: int|null,
 *   paymentID?: string|null,
 *   paymentIntentID?: string|null,
 *   subscriptionID?: string|null,
 *   taxAmount?: int|null,
 *   totalTaxAmount?: int|null,
 *   totalTaxAmounts?: list<array<string,mixed>>|null,
 *   totalTaxes?: list<array<string,mixed>>|null,
 *   transactionID?: string|null,
 * }
 */
final class ParticipantRecordTransactionParams implements BaseModel
{
    /** @use SdkModel<ParticipantRecordTransactionParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    #[Required]
    public string $currency;

    #[Required]
    public int $grossAmount;

    #[Optional]
    public ?int $amountCashNet;

    #[Optional]
    public ?int $amountPaid;

    #[Optional('chargeId')]
    public ?string $chargeID;

    #[Optional('customerId')]
    public ?string $customerID;

    #[Optional]
    public ?string $description;

    #[Optional('externalId')]
    public ?string $externalID;

    #[Optional('invoiceId')]
    public ?string $invoiceID;

    #[Optional]
    public ?int $invoiceSubtotalExcludingTax;

    #[Optional]
    public ?int $invoiceTotal;

    #[Optional]
    public ?int $invoiceTotalExcludingTax;

    #[Optional]
    public ?int $netAmount;

    #[Optional('orderId')]
    public ?string $orderID;

    #[Optional]
    public ?int $paidAt;

    #[Optional('paymentId')]
    public ?string $paymentID;

    #[Optional('paymentIntentId')]
    public ?string $paymentIntentID;

    #[Optional('subscriptionId')]
    public ?string $subscriptionID;

    #[Optional]
    public ?int $taxAmount;

    #[Optional]
    public ?int $totalTaxAmount;

    /** @var list<array<string,mixed>>|null $totalTaxAmounts */
    #[Optional(list: new MapOf('mixed'))]
    public ?array $totalTaxAmounts;

    /** @var list<array<string,mixed>>|null $totalTaxes */
    #[Optional(list: new MapOf('mixed'))]
    public ?array $totalTaxes;

    #[Optional('transactionId')]
    public ?string $transactionID;

    /**
     * `new ParticipantRecordTransactionParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantRecordTransactionParams::with(
     *   id: ..., currency: ..., grossAmount: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantRecordTransactionParams)
     *   ->withID(...)
     *   ->withCurrency(...)
     *   ->withGrossAmount(...)
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
     * @param list<array<string,mixed>>|null $totalTaxAmounts
     * @param list<array<string,mixed>>|null $totalTaxes
     */
    public static function with(
        string $id,
        string $currency,
        int $grossAmount,
        ?int $amountCashNet = null,
        ?int $amountPaid = null,
        ?string $chargeID = null,
        ?string $customerID = null,
        ?string $description = null,
        ?string $externalID = null,
        ?string $invoiceID = null,
        ?int $invoiceSubtotalExcludingTax = null,
        ?int $invoiceTotal = null,
        ?int $invoiceTotalExcludingTax = null,
        ?int $netAmount = null,
        ?string $orderID = null,
        ?int $paidAt = null,
        ?string $paymentID = null,
        ?string $paymentIntentID = null,
        ?string $subscriptionID = null,
        ?int $taxAmount = null,
        ?int $totalTaxAmount = null,
        ?array $totalTaxAmounts = null,
        ?array $totalTaxes = null,
        ?string $transactionID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['currency'] = $currency;
        $self['grossAmount'] = $grossAmount;

        null !== $amountCashNet && $self['amountCashNet'] = $amountCashNet;
        null !== $amountPaid && $self['amountPaid'] = $amountPaid;
        null !== $chargeID && $self['chargeID'] = $chargeID;
        null !== $customerID && $self['customerID'] = $customerID;
        null !== $description && $self['description'] = $description;
        null !== $externalID && $self['externalID'] = $externalID;
        null !== $invoiceID && $self['invoiceID'] = $invoiceID;
        null !== $invoiceSubtotalExcludingTax && $self['invoiceSubtotalExcludingTax'] = $invoiceSubtotalExcludingTax;
        null !== $invoiceTotal && $self['invoiceTotal'] = $invoiceTotal;
        null !== $invoiceTotalExcludingTax && $self['invoiceTotalExcludingTax'] = $invoiceTotalExcludingTax;
        null !== $netAmount && $self['netAmount'] = $netAmount;
        null !== $orderID && $self['orderID'] = $orderID;
        null !== $paidAt && $self['paidAt'] = $paidAt;
        null !== $paymentID && $self['paymentID'] = $paymentID;
        null !== $paymentIntentID && $self['paymentIntentID'] = $paymentIntentID;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;
        null !== $taxAmount && $self['taxAmount'] = $taxAmount;
        null !== $totalTaxAmount && $self['totalTaxAmount'] = $totalTaxAmount;
        null !== $totalTaxAmounts && $self['totalTaxAmounts'] = $totalTaxAmounts;
        null !== $totalTaxes && $self['totalTaxes'] = $totalTaxes;
        null !== $transactionID && $self['transactionID'] = $transactionID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withGrossAmount(int $grossAmount): self
    {
        $self = clone $this;
        $self['grossAmount'] = $grossAmount;

        return $self;
    }

    public function withAmountCashNet(int $amountCashNet): self
    {
        $self = clone $this;
        $self['amountCashNet'] = $amountCashNet;

        return $self;
    }

    public function withAmountPaid(int $amountPaid): self
    {
        $self = clone $this;
        $self['amountPaid'] = $amountPaid;

        return $self;
    }

    public function withChargeID(string $chargeID): self
    {
        $self = clone $this;
        $self['chargeID'] = $chargeID;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

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

    public function withInvoiceSubtotalExcludingTax(
        int $invoiceSubtotalExcludingTax
    ): self {
        $self = clone $this;
        $self['invoiceSubtotalExcludingTax'] = $invoiceSubtotalExcludingTax;

        return $self;
    }

    public function withInvoiceTotal(int $invoiceTotal): self
    {
        $self = clone $this;
        $self['invoiceTotal'] = $invoiceTotal;

        return $self;
    }

    public function withInvoiceTotalExcludingTax(
        int $invoiceTotalExcludingTax
    ): self {
        $self = clone $this;
        $self['invoiceTotalExcludingTax'] = $invoiceTotalExcludingTax;

        return $self;
    }

    public function withNetAmount(int $netAmount): self
    {
        $self = clone $this;
        $self['netAmount'] = $netAmount;

        return $self;
    }

    public function withOrderID(string $orderID): self
    {
        $self = clone $this;
        $self['orderID'] = $orderID;

        return $self;
    }

    public function withPaidAt(int $paidAt): self
    {
        $self = clone $this;
        $self['paidAt'] = $paidAt;

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

    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    public function withTaxAmount(int $taxAmount): self
    {
        $self = clone $this;
        $self['taxAmount'] = $taxAmount;

        return $self;
    }

    public function withTotalTaxAmount(int $totalTaxAmount): self
    {
        $self = clone $this;
        $self['totalTaxAmount'] = $totalTaxAmount;

        return $self;
    }

    /**
     * @param list<array<string,mixed>> $totalTaxAmounts
     */
    public function withTotalTaxAmounts(array $totalTaxAmounts): self
    {
        $self = clone $this;
        $self['totalTaxAmounts'] = $totalTaxAmounts;

        return $self;
    }

    /**
     * @param list<array<string,mixed>> $totalTaxes
     */
    public function withTotalTaxes(array $totalTaxes): self
    {
        $self = clone $this;
        $self['totalTaxes'] = $totalTaxes;

        return $self;
    }

    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}
