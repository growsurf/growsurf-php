<?php

declare(strict_types=1);

namespace Growsurf\Campaign\ParticipantCommissionList;

use Growsurf\Campaign\ParticipantCommissionList\Commission\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type CommissionShape = array{
 *   id: string,
 *   amount: int,
 *   createdAt: int,
 *   currencyISO: string,
 *   referredID: string,
 *   referrerID: string,
 *   saleAmount: int,
 *   status: Status|value-of<Status>,
 *   amountInCampaignCurrency?: int|null,
 *   approvedAt?: int|null,
 *   campaignCurrencyISO?: string|null,
 *   exchangeRate?: float|null,
 *   exchangeRateAt?: int|null,
 *   fxError?: string|null,
 *   holdDuration?: int|null,
 *   paidAt?: int|null,
 *   payoutQueuedAt?: int|null,
 *   provider?: string|null,
 *   reversedAt?: int|null,
 *   saleAmountAmountInCampaignCurrency?: int|null,
 * }
 */
final class Commission implements BaseModel
{
    /** @use SdkModel<CommissionShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public int $amount;

    #[Required]
    public int $createdAt;

    #[Required]
    public string $currencyISO;

    #[Required('referredId')]
    public string $referredID;

    #[Required('referrerId')]
    public string $referrerID;

    #[Required]
    public int $saleAmount;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Optional(nullable: true)]
    public ?int $amountInCampaignCurrency;

    #[Optional]
    public ?int $approvedAt;

    #[Optional(nullable: true)]
    public ?string $campaignCurrencyISO;

    #[Optional(nullable: true)]
    public ?float $exchangeRate;

    #[Optional]
    public ?int $exchangeRateAt;

    #[Optional(nullable: true)]
    public ?string $fxError;

    #[Optional(nullable: true)]
    public ?int $holdDuration;

    #[Optional]
    public ?int $paidAt;

    #[Optional]
    public ?int $payoutQueuedAt;

    #[Optional(nullable: true)]
    public ?string $provider;

    #[Optional]
    public ?int $reversedAt;

    #[Optional(nullable: true)]
    public ?int $saleAmountAmountInCampaignCurrency;

    /**
     * `new Commission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Commission::with(
     *   id: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   currencyISO: ...,
     *   referredID: ...,
     *   referrerID: ...,
     *   saleAmount: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Commission)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCurrencyISO(...)
     *   ->withReferredID(...)
     *   ->withReferrerID(...)
     *   ->withSaleAmount(...)
     *   ->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        int $amount,
        int $createdAt,
        string $currencyISO,
        string $referredID,
        string $referrerID,
        int $saleAmount,
        Status|string $status,
        ?int $amountInCampaignCurrency = null,
        ?int $approvedAt = null,
        ?string $campaignCurrencyISO = null,
        ?float $exchangeRate = null,
        ?int $exchangeRateAt = null,
        ?string $fxError = null,
        ?int $holdDuration = null,
        ?int $paidAt = null,
        ?int $payoutQueuedAt = null,
        ?string $provider = null,
        ?int $reversedAt = null,
        ?int $saleAmountAmountInCampaignCurrency = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['currencyISO'] = $currencyISO;
        $self['referredID'] = $referredID;
        $self['referrerID'] = $referrerID;
        $self['saleAmount'] = $saleAmount;
        $self['status'] = $status;

        null !== $amountInCampaignCurrency && $self['amountInCampaignCurrency'] = $amountInCampaignCurrency;
        null !== $approvedAt && $self['approvedAt'] = $approvedAt;
        null !== $campaignCurrencyISO && $self['campaignCurrencyISO'] = $campaignCurrencyISO;
        null !== $exchangeRate && $self['exchangeRate'] = $exchangeRate;
        null !== $exchangeRateAt && $self['exchangeRateAt'] = $exchangeRateAt;
        null !== $fxError && $self['fxError'] = $fxError;
        null !== $holdDuration && $self['holdDuration'] = $holdDuration;
        null !== $paidAt && $self['paidAt'] = $paidAt;
        null !== $payoutQueuedAt && $self['payoutQueuedAt'] = $payoutQueuedAt;
        null !== $provider && $self['provider'] = $provider;
        null !== $reversedAt && $self['reversedAt'] = $reversedAt;
        null !== $saleAmountAmountInCampaignCurrency && $self['saleAmountAmountInCampaignCurrency'] = $saleAmountAmountInCampaignCurrency;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    public function withCreatedAt(int $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withCurrencyISO(string $currencyISO): self
    {
        $self = clone $this;
        $self['currencyISO'] = $currencyISO;

        return $self;
    }

    public function withReferredID(string $referredID): self
    {
        $self = clone $this;
        $self['referredID'] = $referredID;

        return $self;
    }

    public function withReferrerID(string $referrerID): self
    {
        $self = clone $this;
        $self['referrerID'] = $referrerID;

        return $self;
    }

    public function withSaleAmount(int $saleAmount): self
    {
        $self = clone $this;
        $self['saleAmount'] = $saleAmount;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withAmountInCampaignCurrency(
        ?int $amountInCampaignCurrency
    ): self {
        $self = clone $this;
        $self['amountInCampaignCurrency'] = $amountInCampaignCurrency;

        return $self;
    }

    public function withApprovedAt(int $approvedAt): self
    {
        $self = clone $this;
        $self['approvedAt'] = $approvedAt;

        return $self;
    }

    public function withCampaignCurrencyISO(?string $campaignCurrencyISO): self
    {
        $self = clone $this;
        $self['campaignCurrencyISO'] = $campaignCurrencyISO;

        return $self;
    }

    public function withExchangeRate(?float $exchangeRate): self
    {
        $self = clone $this;
        $self['exchangeRate'] = $exchangeRate;

        return $self;
    }

    public function withExchangeRateAt(int $exchangeRateAt): self
    {
        $self = clone $this;
        $self['exchangeRateAt'] = $exchangeRateAt;

        return $self;
    }

    public function withFxError(?string $fxError): self
    {
        $self = clone $this;
        $self['fxError'] = $fxError;

        return $self;
    }

    public function withHoldDuration(?int $holdDuration): self
    {
        $self = clone $this;
        $self['holdDuration'] = $holdDuration;

        return $self;
    }

    public function withPaidAt(int $paidAt): self
    {
        $self = clone $this;
        $self['paidAt'] = $paidAt;

        return $self;
    }

    public function withPayoutQueuedAt(int $payoutQueuedAt): self
    {
        $self = clone $this;
        $self['payoutQueuedAt'] = $payoutQueuedAt;

        return $self;
    }

    public function withProvider(?string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    public function withReversedAt(int $reversedAt): self
    {
        $self = clone $this;
        $self['reversedAt'] = $reversedAt;

        return $self;
    }

    public function withSaleAmountAmountInCampaignCurrency(
        ?int $saleAmountAmountInCampaignCurrency
    ): self {
        $self = clone $this;
        $self['saleAmountAmountInCampaignCurrency'] = $saleAmountAmountInCampaignCurrency;

        return $self;
    }
}
