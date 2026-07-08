<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\Reward\LimitDuration;
use Growsurf\Campaign\Reward\Type;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * A single campaign reward (also known as a `CampaignReward`). This is different from a `ParticipantReward`, which is a reward earned by a participant.
 *
 * @phpstan-import-type CommissionStructureShape from \Growsurf\Campaign\CommissionStructure
 * @phpstan-import-type RewardTaxValuationShape from \Growsurf\Campaign\RewardTaxValuation
 *
 * @phpstan-type RewardShape = array{
 *   id: string,
 *   isUnlimited: bool,
 *   metadata: array<string,mixed>,
 *   type: Type|value-of<Type>,
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

    /**
     * The unique identifier of the campaign reward. You can find this ID from *Program Editor > 1. Rewards* and clicking the reward.
     */
    #[Required]
    public string $id;

    /**
     * `true` if this reward can be earned by a single participant an unlimited number of times.
     */
    #[Required]
    public bool $isUnlimited;

    /**
     * The reward metadata.
     *
     * @var array<string,mixed> $metadata
     */
    #[Required(map: 'mixed')]
    public array $metadata;

    /**
     * The reward type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The reward commission structure. Present only for affiliate programs.
     */
    #[Optional(nullable: true)]
    public ?CommissionStructure $commissionStructure;

    /**
     * The number of referrals a participant must make to earn this reward.
     */
    #[Optional(nullable: true)]
    public ?int $conversionsRequired;

    /**
     * A legacy static coupon code shown to the referrer in the reward-won email and webhook. Display text only (GrowSurf does not create or validate it); superseded by a connected billing integration's issued coupon when one exists.
     */
    #[Optional(nullable: true)]
    public ?string $couponCode;

    /**
     * The reward description shown to the referrer.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * The reward image URL.
     */
    #[Optional('imageUrl', nullable: true)]
    public ?string $imageURL;

    /**
     * The number of times a participant can earn this reward (overridden when `isUnlimited` is `true`). `-1` represents an unlimited reward in REST responses.
     */
    #[Optional(nullable: true)]
    public ?int $limit;

    /**
     * Whether the reward can be earned in total, on a monthly basis, or on a yearly basis.
     *
     * @var value-of<LimitDuration>|null $limitDuration
     */
    #[Optional(enum: LimitDuration::class, nullable: true)]
    public ?string $limitDuration;

    /**
     * Text displayed in front of a participant's referral count for UI purposes (e.g., "You are only"). Applicable for milestone rewards (when `type` is `MILESTONE`).
     */
    #[Optional(nullable: true)]
    public ?string $nextMilestonePrefix;

    /**
     * Text displayed after a participant's referral count for UI purposes (e.g., "referrals away from receiving a nice reward!"). Applicable for milestone rewards (when `type` is `MILESTONE`).
     */
    #[Optional(nullable: true)]
    public ?string $nextMilestoneSuffix;

    /**
     * The maximum number of winners. Only applies to `LEADERBOARD` rewards. When `limitDuration` is `PER_MONTH`, this many top referrers win each month; otherwise this many win in total.
     */
    #[Optional(nullable: true)]
    public ?int $numberOfWinners;

    /**
     * If there are multiple rewards, the order in which the reward should be displayed. `null` by default until set within the Design step of the program editor.
     */
    #[Optional(nullable: true)]
    public ?int $order;

    /**
     * A legacy static coupon code shown to the referred friend in the reward-won email and webhook (double-sided rewards). Same caveats as `couponCode`.
     */
    #[Optional(nullable: true)]
    public ?string $referralCouponCode;

    /**
     * The reward description shown to the referred friend (only applicable for double-sided reward types).
     */
    #[Optional(nullable: true)]
    public ?string $referralDescription;

    /**
     * Only applies to double-sided rewards. When `true`, the referred friend's reward is delivered upfront as a discount and no `ParticipantReward` is created for them when the referral triggers.
     */
    #[Optional]
    public ?bool $referredRewardUpfront;

    /**
     * Tax valuation for the referred friend's side of a double-sided reward.
     */
    #[Optional(nullable: true)]
    public ?RewardTaxValuation $referredValue;

    /**
     * Tax valuation for the reward (the referrer's side of a double-sided reward).
     */
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
     * The reward metadata.
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
     * The reward type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The reward commission structure. Present only for affiliate programs.
     *
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
     * The number of referrals a participant must make to earn this reward.
     */
    public function withConversionsRequired(?int $conversionsRequired): self
    {
        $self = clone $this;
        $self['conversionsRequired'] = $conversionsRequired;

        return $self;
    }

    /**
     * A legacy static coupon code shown to the referrer in the reward-won email and webhook. Display text only (GrowSurf does not create or validate it); superseded by a connected billing integration's issued coupon when one exists.
     */
    public function withCouponCode(?string $couponCode): self
    {
        $self = clone $this;
        $self['couponCode'] = $couponCode;

        return $self;
    }

    /**
     * The reward description shown to the referrer.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The reward image URL.
     */
    public function withImageURL(?string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * The number of times a participant can earn this reward (overridden when `isUnlimited` is `true`). `-1` represents an unlimited reward in REST responses.
     */
    public function withLimit(?int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Whether the reward can be earned in total, on a monthly basis, or on a yearly basis.
     *
     * @param LimitDuration|value-of<LimitDuration>|null $limitDuration
     */
    public function withLimitDuration(
        LimitDuration|string|null $limitDuration
    ): self {
        $self = clone $this;
        $self['limitDuration'] = $limitDuration;

        return $self;
    }

    /**
     * Text displayed in front of a participant's referral count for UI purposes (e.g., "You are only"). Applicable for milestone rewards (when `type` is `MILESTONE`).
     */
    public function withNextMilestonePrefix(?string $nextMilestonePrefix): self
    {
        $self = clone $this;
        $self['nextMilestonePrefix'] = $nextMilestonePrefix;

        return $self;
    }

    /**
     * Text displayed after a participant's referral count for UI purposes (e.g., "referrals away from receiving a nice reward!"). Applicable for milestone rewards (when `type` is `MILESTONE`).
     */
    public function withNextMilestoneSuffix(?string $nextMilestoneSuffix): self
    {
        $self = clone $this;
        $self['nextMilestoneSuffix'] = $nextMilestoneSuffix;

        return $self;
    }

    /**
     * The maximum number of winners. Only applies to `LEADERBOARD` rewards. When `limitDuration` is `PER_MONTH`, this many top referrers win each month; otherwise this many win in total.
     */
    public function withNumberOfWinners(?int $numberOfWinners): self
    {
        $self = clone $this;
        $self['numberOfWinners'] = $numberOfWinners;

        return $self;
    }

    /**
     * If there are multiple rewards, the order in which the reward should be displayed. `null` by default until set within the Design step of the program editor.
     */
    public function withOrder(?int $order): self
    {
        $self = clone $this;
        $self['order'] = $order;

        return $self;
    }

    /**
     * A legacy static coupon code shown to the referred friend in the reward-won email and webhook (double-sided rewards). Same caveats as `couponCode`.
     */
    public function withReferralCouponCode(?string $referralCouponCode): self
    {
        $self = clone $this;
        $self['referralCouponCode'] = $referralCouponCode;

        return $self;
    }

    /**
     * The reward description shown to the referred friend (only applicable for double-sided reward types).
     */
    public function withReferralDescription(?string $referralDescription): self
    {
        $self = clone $this;
        $self['referralDescription'] = $referralDescription;

        return $self;
    }

    /**
     * Only applies to double-sided rewards. When `true`, the referred friend's reward is delivered upfront as a discount and no `ParticipantReward` is created for them when the referral triggers.
     */
    public function withReferredRewardUpfront(bool $referredRewardUpfront): self
    {
        $self = clone $this;
        $self['referredRewardUpfront'] = $referredRewardUpfront;

        return $self;
    }

    /**
     * Tax valuation for the referred friend's side of a double-sided reward.
     *
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
     * Tax valuation for the reward (the referrer's side of a double-sided reward).
     *
     * @param RewardTaxValuation|RewardTaxValuationShape|null $value
     */
    public function withValue(RewardTaxValuation|array|null $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
