<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\CommissionStructure;
use Growsurf\Campaign\Participant\ParticipantReward\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CommissionStructureShape from \Growsurf\Campaign\CommissionStructure
 *
 * @phpstan-type ParticipantRewardShape = array{
 *   id: string,
 *   rewardID: string,
 *   status: Status|value-of<Status>,
 *   amount?: float|int|null,
 *   approved?: bool|null,
 *   approvedAt?: int|null,
 *   commissionStructure?: null|CommissionStructure|CommissionStructureShape,
 *   currencyISO?: string|null,
 *   fulfilledAt?: int|null,
 *   isAvailable?: bool|null,
 *   isFulfilled?: bool|null,
 *   isReferrer?: bool|null,
 *   referredID?: string|null,
 *   referrerID?: string|null,
 *   unread?: bool|null,
 * }
 */
final class ParticipantReward implements BaseModel
{
    /** @use SdkModel<ParticipantRewardShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('rewardId')]
    public string $rewardID;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * What this reward delivered, in major units, when the reward records a delivered amount.
     */
    #[Optional(nullable: true)]
    public float|int|null $amount;

    #[Optional]
    public ?bool $approved;

    #[Optional]
    public ?int $approvedAt;

    #[Optional(nullable: true)]
    public ?CommissionStructure $commissionStructure;

    /**
     * The ISO 4217 currency code for `amount`. `null` whenever `amount` is `null`.
     */
    #[Optional(nullable: true)]
    public ?string $currencyISO;

    #[Optional]
    public ?int $fulfilledAt;

    #[Optional]
    public ?bool $isAvailable;

    #[Optional]
    public ?bool $isFulfilled;

    #[Optional]
    public ?bool $isReferrer;

    #[Optional('referredId')]
    public ?string $referredID;

    #[Optional('referrerId')]
    public ?string $referrerID;

    #[Optional]
    public ?bool $unread;

    /**
     * `new ParticipantReward()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantReward::with(id: ..., rewardID: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantReward)->withID(...)->withRewardID(...)->withStatus(...)
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
     * @param CommissionStructure|CommissionStructureShape|null $commissionStructure
     */
    public static function with(
        string $id,
        string $rewardID,
        Status|string $status,
        ?bool $approved = null,
        ?int $approvedAt = null,
        CommissionStructure|array|null $commissionStructure = null,
        ?int $fulfilledAt = null,
        ?bool $isAvailable = null,
        ?bool $isFulfilled = null,
        ?bool $isReferrer = null,
        ?string $referredID = null,
        ?string $referrerID = null,
        ?bool $unread = null,
        float|int|null $amount = null,
        ?string $currencyISO = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['rewardID'] = $rewardID;
        $self['status'] = $status;

        null !== $approved && $self['approved'] = $approved;
        null !== $approvedAt && $self['approvedAt'] = $approvedAt;
        null !== $commissionStructure && $self['commissionStructure'] = $commissionStructure;
        null !== $fulfilledAt && $self['fulfilledAt'] = $fulfilledAt;
        null !== $isAvailable && $self['isAvailable'] = $isAvailable;
        null !== $isFulfilled && $self['isFulfilled'] = $isFulfilled;
        null !== $isReferrer && $self['isReferrer'] = $isReferrer;
        null !== $referredID && $self['referredID'] = $referredID;
        null !== $referrerID && $self['referrerID'] = $referrerID;
        null !== $unread && $self['unread'] = $unread;
        null !== $amount && $self['amount'] = $amount;
        null !== $currencyISO && $self['currencyISO'] = $currencyISO;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withRewardID(string $rewardID): self
    {
        $self = clone $this;
        $self['rewardID'] = $rewardID;

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

    /**
     * What this reward delivered, in major units, when the reward records a delivered amount.
     */
    public function withAmount(float|int|null $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    public function withApproved(bool $approved): self
    {
        $self = clone $this;
        $self['approved'] = $approved;

        return $self;
    }

    public function withApprovedAt(int $approvedAt): self
    {
        $self = clone $this;
        $self['approvedAt'] = $approvedAt;

        return $self;
    }

    /**
     * @param CommissionStructure|CommissionStructureShape|null $commissionStructure
     */
    public function withCommissionStructure(
        CommissionStructure|array|null $commissionStructure
    ): self {
        $self = clone $this;
        $self['commissionStructure'] = $commissionStructure;

        return $self;
    }

    /**
     * The ISO 4217 currency code for `amount`. `null` whenever `amount` is `null`.
     */
    public function withCurrencyISO(?string $currencyISO): self
    {
        $self = clone $this;
        $self['currencyISO'] = $currencyISO;

        return $self;
    }

    public function withFulfilledAt(int $fulfilledAt): self
    {
        $self = clone $this;
        $self['fulfilledAt'] = $fulfilledAt;

        return $self;
    }

    public function withIsAvailable(bool $isAvailable): self
    {
        $self = clone $this;
        $self['isAvailable'] = $isAvailable;

        return $self;
    }

    public function withIsFulfilled(bool $isFulfilled): self
    {
        $self = clone $this;
        $self['isFulfilled'] = $isFulfilled;

        return $self;
    }

    public function withIsReferrer(bool $isReferrer): self
    {
        $self = clone $this;
        $self['isReferrer'] = $isReferrer;

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

    public function withUnread(bool $unread): self
    {
        $self = clone $this;
        $self['unread'] = $unread;

        return $self;
    }
}
