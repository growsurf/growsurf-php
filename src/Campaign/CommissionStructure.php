<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CommissionStructure\Type;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type CommissionStructureShape = array{
 *   amount?: int|null,
 *   amountISO?: string|null,
 *   approvalRequired?: bool|null,
 *   duration?: string|null,
 *   durationInMonths?: int|null,
 *   event?: string|null,
 *   hasIntro?: bool|null,
 *   hasMaxAmount?: bool|null,
 *   holdDuration?: int|null,
 *   introAmount?: int|null,
 *   introAmountISO?: string|null,
 *   introDuration?: string|null,
 *   introDurationInMonths?: int|null,
 *   introPercent?: float|null,
 *   introType?: string|null,
 *   maxAmount?: int|null,
 *   maxAmountISO?: string|null,
 *   minPaidReferrals?: int|null,
 *   percent?: float|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class CommissionStructure implements BaseModel
{
    /** @use SdkModel<CommissionStructureShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?int $amount;

    #[Optional(nullable: true)]
    public ?string $amountISO;

    #[Optional(nullable: true)]
    public ?bool $approvalRequired;

    #[Optional(nullable: true)]
    public ?string $duration;

    #[Optional(nullable: true)]
    public ?int $durationInMonths;

    #[Optional(nullable: true)]
    public ?string $event;

    #[Optional(nullable: true)]
    public ?bool $hasIntro;

    #[Optional(nullable: true)]
    public ?bool $hasMaxAmount;

    #[Optional(nullable: true)]
    public ?int $holdDuration;

    #[Optional(nullable: true)]
    public ?int $introAmount;

    #[Optional(nullable: true)]
    public ?string $introAmountISO;

    #[Optional(nullable: true)]
    public ?string $introDuration;

    #[Optional(nullable: true)]
    public ?int $introDurationInMonths;

    #[Optional(nullable: true)]
    public ?float $introPercent;

    #[Optional(nullable: true)]
    public ?string $introType;

    #[Optional(nullable: true)]
    public ?int $maxAmount;

    #[Optional(nullable: true)]
    public ?string $maxAmountISO;

    #[Optional(nullable: true)]
    public ?int $minPaidReferrals;

    #[Optional(nullable: true)]
    public ?float $percent;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class, nullable: true)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?int $amount = null,
        ?string $amountISO = null,
        ?bool $approvalRequired = null,
        ?string $duration = null,
        ?int $durationInMonths = null,
        ?string $event = null,
        ?bool $hasIntro = null,
        ?bool $hasMaxAmount = null,
        ?int $holdDuration = null,
        ?int $introAmount = null,
        ?string $introAmountISO = null,
        ?string $introDuration = null,
        ?int $introDurationInMonths = null,
        ?float $introPercent = null,
        ?string $introType = null,
        ?int $maxAmount = null,
        ?string $maxAmountISO = null,
        ?int $minPaidReferrals = null,
        ?float $percent = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $amount && $self['amount'] = $amount;
        null !== $amountISO && $self['amountISO'] = $amountISO;
        null !== $approvalRequired && $self['approvalRequired'] = $approvalRequired;
        null !== $duration && $self['duration'] = $duration;
        null !== $durationInMonths && $self['durationInMonths'] = $durationInMonths;
        null !== $event && $self['event'] = $event;
        null !== $hasIntro && $self['hasIntro'] = $hasIntro;
        null !== $hasMaxAmount && $self['hasMaxAmount'] = $hasMaxAmount;
        null !== $holdDuration && $self['holdDuration'] = $holdDuration;
        null !== $introAmount && $self['introAmount'] = $introAmount;
        null !== $introAmountISO && $self['introAmountISO'] = $introAmountISO;
        null !== $introDuration && $self['introDuration'] = $introDuration;
        null !== $introDurationInMonths && $self['introDurationInMonths'] = $introDurationInMonths;
        null !== $introPercent && $self['introPercent'] = $introPercent;
        null !== $introType && $self['introType'] = $introType;
        null !== $maxAmount && $self['maxAmount'] = $maxAmount;
        null !== $maxAmountISO && $self['maxAmountISO'] = $maxAmountISO;
        null !== $minPaidReferrals && $self['minPaidReferrals'] = $minPaidReferrals;
        null !== $percent && $self['percent'] = $percent;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withAmount(?int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    public function withAmountISO(?string $amountISO): self
    {
        $self = clone $this;
        $self['amountISO'] = $amountISO;

        return $self;
    }

    public function withApprovalRequired(?bool $approvalRequired): self
    {
        $self = clone $this;
        $self['approvalRequired'] = $approvalRequired;

        return $self;
    }

    public function withDuration(?string $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    public function withDurationInMonths(?int $durationInMonths): self
    {
        $self = clone $this;
        $self['durationInMonths'] = $durationInMonths;

        return $self;
    }

    public function withEvent(?string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    public function withHasIntro(?bool $hasIntro): self
    {
        $self = clone $this;
        $self['hasIntro'] = $hasIntro;

        return $self;
    }

    public function withHasMaxAmount(?bool $hasMaxAmount): self
    {
        $self = clone $this;
        $self['hasMaxAmount'] = $hasMaxAmount;

        return $self;
    }

    public function withHoldDuration(?int $holdDuration): self
    {
        $self = clone $this;
        $self['holdDuration'] = $holdDuration;

        return $self;
    }

    public function withIntroAmount(?int $introAmount): self
    {
        $self = clone $this;
        $self['introAmount'] = $introAmount;

        return $self;
    }

    public function withIntroAmountISO(?string $introAmountISO): self
    {
        $self = clone $this;
        $self['introAmountISO'] = $introAmountISO;

        return $self;
    }

    public function withIntroDuration(?string $introDuration): self
    {
        $self = clone $this;
        $self['introDuration'] = $introDuration;

        return $self;
    }

    public function withIntroDurationInMonths(?int $introDurationInMonths): self
    {
        $self = clone $this;
        $self['introDurationInMonths'] = $introDurationInMonths;

        return $self;
    }

    public function withIntroPercent(?float $introPercent): self
    {
        $self = clone $this;
        $self['introPercent'] = $introPercent;

        return $self;
    }

    public function withIntroType(?string $introType): self
    {
        $self = clone $this;
        $self['introType'] = $introType;

        return $self;
    }

    public function withMaxAmount(?int $maxAmount): self
    {
        $self = clone $this;
        $self['maxAmount'] = $maxAmount;

        return $self;
    }

    public function withMaxAmountISO(?string $maxAmountISO): self
    {
        $self = clone $this;
        $self['maxAmountISO'] = $maxAmountISO;

        return $self;
    }

    public function withMinPaidReferrals(?int $minPaidReferrals): self
    {
        $self = clone $this;
        $self['minPaidReferrals'] = $minPaidReferrals;

        return $self;
    }

    public function withPercent(?float $percent): self
    {
        $self = clone $this;
        $self['percent'] = $percent;

        return $self;
    }

    /**
     * @param Type|value-of<Type>|null $type
     */
    public function withType(Type|string|null $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
