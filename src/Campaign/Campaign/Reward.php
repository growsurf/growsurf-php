<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Campaign;

use Growsurf\Campaign\Campaign\Reward\LimitDuration;
use Growsurf\Campaign\Campaign\Reward\Type;
use Growsurf\Campaign\CommissionStructure;
use Growsurf\Campaign\RewardTaxValuation;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CommissionStructureShape from \Growsurf\Campaign\CommissionStructure
 * @phpstan-import-type RewardTaxValuationShape from \Growsurf\Campaign\RewardTaxValuation
 *
 * @phpstan-type RewardShape = array{
 *   id: string,
 *   isUnlimited: bool,
 *   metadata: array<string,mixed>,
 *   type: \Growsurf\Campaign\Campaign\Reward\Type|value-of<\Growsurf\Campaign\Campaign\Reward\Type>,
 *   commissionStructure?: null|CommissionStructure|CommissionStructureShape,
 *   conversionsRequired?: int|null,
 *   couponCode?: string|null,
 *   description?: string|null,
 *   imageURL?: string|null,
 *   limit?: int|null,
 *   limitDuration?: null|LimitDuration|value-of<LimitDuration>,
 *   nextMilestonePrefix?: string|null,
 *   nextMilestoneSuffix?: string|null,
 *   numberOfWinners?: int|null,
 *   order?: int|null,
 *   referralCouponCode?: string|null,
 *   referralDescription?: string|null,
 *   referredRewardUpfront?: bool|null,
 *   referredValue?: null|RewardTaxValuation|RewardTaxValuationShape,
 *   value?: null|RewardTaxValuation|RewardTaxValuationShape,
 * }
 */
final class Reward implements BaseModel
{
    /** @use SdkModel<RewardShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public bool $isUnlimited;

    /**
     * Shallow custom metadata object.
     *
     * @var array<string,mixed> $metadata
     */
    #[Required(map: 'mixed')]
    public array $metadata;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional(nullable: true)]
    public ?CommissionStructure $commissionStructure;

    #[Optional(nullable: true)]
    public ?int $conversionsRequired;

    #[Optional(nullable: true)]
    public ?string $couponCode;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional('imageUrl', nullable: true)]
    public ?string $imageURL;

    /**
     * `-1` represents an unlimited reward in REST responses.
     */
    #[Optional(nullable: true)]
    public ?int $limit;

    /** @var value-of<LimitDuration>|null $limitDuration */
    #[Optional(enum: LimitDuration::class, nullable: true)]
    public ?string $limitDuration;

    #[Optional(nullable: true)]
    public ?string $nextMilestonePrefix;

    #[Optional(nullable: true)]
    public ?string $nextMilestoneSuffix;

    #[Optional(nullable: true)]
    public ?int $numberOfWinners;

    #[Optional(nullable: true)]
    public ?int $order;

    #[Optional(nullable: true)]
    public ?string $referralCouponCode;

    #[Optional(nullable: true)]
    public ?string $referralDescription;

    #[Optional]
    public ?bool $referredRewardUpfront;

    #[Optional(nullable: true)]
    public ?RewardTaxValuation $referredValue;

    #[Optional(nullable: true)]
    public ?RewardTaxValuation $value;

    /**
     * `new Reward()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Reward::with(id: ..., isUnlimited: ..., metadata: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Reward)
     *   ->withID(...)
     *   ->withIsUnlimited(...)
     *   ->withMetadata(...)
     *   ->withType(...)
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
     * @param array<string,mixed> $metadata
     * @param Type|value-of<Type> $type
     * @param CommissionStructure|CommissionStructureShape|null $commissionStructure
     * @param LimitDuration|value-of<LimitDuration>|null $limitDuration
     * @param RewardTaxValuation|RewardTaxValuationShape|null $referredValue
     * @param RewardTaxValuation|RewardTaxValuationShape|null $value
     */
    public static function with(
        string $id,
        bool $isUnlimited,
        array $metadata,
        Type|string $type,
        CommissionStructure|array|null $commissionStructure = null,
        ?int $conversionsRequired = null,
        ?string $couponCode = null,
        ?string $description = null,
        ?string $imageURL = null,
        ?int $limit = null,
        LimitDuration|string|null $limitDuration = null,
        ?string $nextMilestonePrefix = null,
        ?string $nextMilestoneSuffix = null,
        ?int $numberOfWinners = null,
        ?int $order = null,
        ?string $referralCouponCode = null,
        ?string $referralDescription = null,
        ?bool $referredRewardUpfront = null,
        RewardTaxValuation|array|null $referredValue = null,
        RewardTaxValuation|array|null $value = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['isUnlimited'] = $isUnlimited;
        $self['metadata'] = $metadata;
        $self['type'] = $type;

        null !== $commissionStructure && $self['commissionStructure'] = $commissionStructure;
        null !== $conversionsRequired && $self['conversionsRequired'] = $conversionsRequired;
        null !== $couponCode && $self['couponCode'] = $couponCode;
        null !== $description && $self['description'] = $description;
        null !== $imageURL && $self['imageURL'] = $imageURL;
        null !== $limit && $self['limit'] = $limit;
        null !== $limitDuration && $self['limitDuration'] = $limitDuration;
        null !== $nextMilestonePrefix && $self['nextMilestonePrefix'] = $nextMilestonePrefix;
        null !== $nextMilestoneSuffix && $self['nextMilestoneSuffix'] = $nextMilestoneSuffix;
        null !== $numberOfWinners && $self['numberOfWinners'] = $numberOfWinners;
        null !== $order && $self['order'] = $order;
        null !== $referralCouponCode && $self['referralCouponCode'] = $referralCouponCode;
        null !== $referralDescription && $self['referralDescription'] = $referralDescription;
        null !== $referredRewardUpfront && $self['referredRewardUpfront'] = $referredRewardUpfront;
        null !== $referredValue && $self['referredValue'] = $referredValue;
        null !== $value && $self['value'] = $value;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withIsUnlimited(bool $isUnlimited): self
    {
        $self = clone $this;
        $self['isUnlimited'] = $isUnlimited;

        return $self;
    }

    /**
     * Shallow custom metadata object.
     *
     * @param array<string,mixed> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(
        Type|string $type
    ): self {
        $self = clone $this;
        $self['type'] = $type;

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

    public function withConversionsRequired(?int $conversionsRequired): self
    {
        $self = clone $this;
        $self['conversionsRequired'] = $conversionsRequired;

        return $self;
    }

    public function withCouponCode(?string $couponCode): self
    {
        $self = clone $this;
        $self['couponCode'] = $couponCode;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withImageURL(?string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * `-1` represents an unlimited reward in REST responses.
     */
    public function withLimit(?int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * @param LimitDuration|value-of<LimitDuration>|null $limitDuration
     */
    public function withLimitDuration(
        LimitDuration|string|null $limitDuration
    ): self {
        $self = clone $this;
        $self['limitDuration'] = $limitDuration;

        return $self;
    }

    public function withNextMilestonePrefix(?string $nextMilestonePrefix): self
    {
        $self = clone $this;
        $self['nextMilestonePrefix'] = $nextMilestonePrefix;

        return $self;
    }

    public function withNextMilestoneSuffix(?string $nextMilestoneSuffix): self
    {
        $self = clone $this;
        $self['nextMilestoneSuffix'] = $nextMilestoneSuffix;

        return $self;
    }

    public function withNumberOfWinners(?int $numberOfWinners): self
    {
        $self = clone $this;
        $self['numberOfWinners'] = $numberOfWinners;

        return $self;
    }

    public function withOrder(?int $order): self
    {
        $self = clone $this;
        $self['order'] = $order;

        return $self;
    }

    public function withReferralCouponCode(?string $referralCouponCode): self
    {
        $self = clone $this;
        $self['referralCouponCode'] = $referralCouponCode;

        return $self;
    }

    public function withReferralDescription(?string $referralDescription): self
    {
        $self = clone $this;
        $self['referralDescription'] = $referralDescription;

        return $self;
    }

    public function withReferredRewardUpfront(bool $referredRewardUpfront): self
    {
        $self = clone $this;
        $self['referredRewardUpfront'] = $referredRewardUpfront;

        return $self;
    }

    /**
     * @param RewardTaxValuation|RewardTaxValuationShape|null $referredValue
     */
    public function withReferredValue(
        RewardTaxValuation|array|null $referredValue
    ): self {
        $self = clone $this;
        $self['referredValue'] = $referredValue;

        return $self;
    }

    /**
     * @param RewardTaxValuation|RewardTaxValuationShape|null $value
     */
    public function withValue(RewardTaxValuation|array|null $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
