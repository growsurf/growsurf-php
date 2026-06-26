<?php

declare(strict_types=1);

namespace Growsurf\Campaign\ParticipantPayoutList;

use Growsurf\Campaign\ParticipantPayoutList\Payout\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type PayoutShape = array{
 *   id: string,
 *   amount: int,
 *   commissionIDs: list<string>,
 *   createdAt: int,
 *   currencyISO: string,
 *   participantID: string,
 *   status: Status|value-of<Status>,
 *   amountInCampaignCurrency?: int|null,
 *   campaignCurrencyISO?: string|null,
 *   exchangeRate?: float|null,
 *   exchangeRateAt?: int|null,
 *   failedAt?: int|null,
 *   fxError?: string|null,
 *   issuedAt?: int|null,
 *   provider?: string|null,
 *   queuedAt?: int|null,
 * }
 */
final class Payout implements BaseModel
{
    /** @use SdkModel<PayoutShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public int $amount;

    /** @var list<string> $commissionIDs */
    #[Required('commissionIds', list: 'string')]
    public array $commissionIDs;

    #[Required]
    public int $createdAt;

    #[Required]
    public string $currencyISO;

    #[Required('participantId')]
    public string $participantID;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Optional(nullable: true)]
    public ?int $amountInCampaignCurrency;

    #[Optional(nullable: true)]
    public ?string $campaignCurrencyISO;

    #[Optional(nullable: true)]
    public ?float $exchangeRate;

    #[Optional]
    public ?int $exchangeRateAt;

    #[Optional]
    public ?int $failedAt;

    #[Optional(nullable: true)]
    public ?string $fxError;

    #[Optional]
    public ?int $issuedAt;

    #[Optional(nullable: true)]
    public ?string $provider;

    #[Optional]
    public ?int $queuedAt;

    /**
     * `new Payout()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Payout::with(
     *   id: ...,
     *   amount: ...,
     *   commissionIDs: ...,
     *   createdAt: ...,
     *   currencyISO: ...,
     *   participantID: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Payout)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withCommissionIDs(...)
     *   ->withCreatedAt(...)
     *   ->withCurrencyISO(...)
     *   ->withParticipantID(...)
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
     * @param list<string> $commissionIDs
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        int $amount,
        array $commissionIDs,
        int $createdAt,
        string $currencyISO,
        string $participantID,
        Status|string $status,
        ?int $amountInCampaignCurrency = null,
        ?string $campaignCurrencyISO = null,
        ?float $exchangeRate = null,
        ?int $exchangeRateAt = null,
        ?int $failedAt = null,
        ?string $fxError = null,
        ?int $issuedAt = null,
        ?string $provider = null,
        ?int $queuedAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['commissionIDs'] = $commissionIDs;
        $self['createdAt'] = $createdAt;
        $self['currencyISO'] = $currencyISO;
        $self['participantID'] = $participantID;
        $self['status'] = $status;

        null !== $amountInCampaignCurrency && $self['amountInCampaignCurrency'] = $amountInCampaignCurrency;
        null !== $campaignCurrencyISO && $self['campaignCurrencyISO'] = $campaignCurrencyISO;
        null !== $exchangeRate && $self['exchangeRate'] = $exchangeRate;
        null !== $exchangeRateAt && $self['exchangeRateAt'] = $exchangeRateAt;
        null !== $failedAt && $self['failedAt'] = $failedAt;
        null !== $fxError && $self['fxError'] = $fxError;
        null !== $issuedAt && $self['issuedAt'] = $issuedAt;
        null !== $provider && $self['provider'] = $provider;
        null !== $queuedAt && $self['queuedAt'] = $queuedAt;

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

    /**
     * @param list<string> $commissionIDs
     */
    public function withCommissionIDs(array $commissionIDs): self
    {
        $self = clone $this;
        $self['commissionIDs'] = $commissionIDs;

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

    public function withParticipantID(string $participantID): self
    {
        $self = clone $this;
        $self['participantID'] = $participantID;

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

    public function withFailedAt(int $failedAt): self
    {
        $self = clone $this;
        $self['failedAt'] = $failedAt;

        return $self;
    }

    public function withFxError(?string $fxError): self
    {
        $self = clone $this;
        $self['fxError'] = $fxError;

        return $self;
    }

    public function withIssuedAt(int $issuedAt): self
    {
        $self = clone $this;
        $self['issuedAt'] = $issuedAt;

        return $self;
    }

    public function withProvider(?string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    public function withQueuedAt(int $queuedAt): self
    {
        $self = clone $this;
        $self['queuedAt'] = $queuedAt;

        return $self;
    }
}
