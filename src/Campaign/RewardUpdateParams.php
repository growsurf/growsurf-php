<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\RewardUpdateParams\LimitDuration;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Updates an existing campaign reward (`CampaignReward`). All fields are optional; `type` is immutable and must not be supplied.
 *
 * @see Growsurf\Services\Campaign\RewardsService::update()
 *
 * @phpstan-import-type CommissionStructureShape from \Growsurf\Campaign\CommissionStructure
 * @phpstan-import-type RewardTaxValuationShape from \Growsurf\Campaign\RewardTaxValuation
 *
 * @phpstan-type RewardUpdateParamsShape = array{
 *   id: string,
 *   commissionStructure?: null|CommissionStructure|CommissionStructureShape,
 *   conversionsRequired?: int|null,
 *   couponCode?: string|null,
 *   description?: string|null,
 *   imageURL?: string|null,
 *   isUnlimited?: bool|null,
 *   isVisible?: bool|null,
 *   limit?: int|null,
 *   limitDuration?: null|LimitDuration|value-of<LimitDuration>,
 *   metadata?: array<string,mixed>|null,
 *   nextMilestonePrefix?: string|null,
 *   nextMilestoneSuffix?: string|null,
 *   numberOfWinners?: int|null,
 *   order?: int|null,
 *   referralCouponCode?: string|null,
 *   referralDescription?: string|null,
 *   referredRewardUpfront?: bool|null,
 *   referredValue?: null|RewardTaxValuation|RewardTaxValuationShape,
 *   title?: string|null,
 *   value?: null|RewardTaxValuation|RewardTaxValuationShape,
 * }
 */
final class RewardUpdateParams implements BaseModel
{
    /** @use SdkModel<RewardUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * The affiliate commission structure (AFFILIATE rewards only).
     */
    #[Optional]
    public ?CommissionStructure $commissionStructure;

    /**
     * The number of referrals required to earn the reward.
     */
    #[Optional]
    public ?int $conversionsRequired;

    /**
     * A legacy static coupon code shown to the referrer in the reward-won email and webhook. Display text only (GrowSurf does not create or validate it); superseded by a connected billing integration's issued coupon when one exists.
     */
    #[Optional]
    public ?string $couponCode;

    /**
     * The reward description shown to the referrer.
     */
    #[Optional]
    public ?string $description;

    /**
     * An image URL for the reward.
     */
    #[Optional('imageUrl')]
    public ?string $imageURL;

    /**
     * Whether the reward can be earned an unlimited number of times. Defaults to `true`, except `MILESTONE` rewards, which can only be earned once.
     */
    #[Optional]
    public ?bool $isUnlimited;

    /**
     * Whether the reward is enabled. When `false`, the reward is disabled: no longer awarded (including to participants who already earned it) and hidden from participants.
     */
    #[Optional]
    public ?bool $isVisible;

    /**
     * The number of times a participant can earn the reward (overridden by `isUnlimited`).
     */
    #[Optional]
    public ?int $limit;

    /**
     * The window over which `limit` applies.
     *
     * @var value-of<LimitDuration>|null $limitDuration
     */
    #[Optional(enum: LimitDuration::class)]
    public ?string $limitDuration;

    /**
     * Custom key/value metadata (single-level; values are stored as strings).
     *
     * @var array<string,mixed>|null $metadata
     */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    /**
     * Text shown before a participant's referral count in milestone progress copy (e.g. "You are only"). Applies to `MILESTONE` rewards.
     */
    #[Optional]
    public ?string $nextMilestonePrefix;

    /**
     * Text shown after a participant's referral count in milestone progress copy (e.g. "referrals away from your next reward!"). Applies to `MILESTONE` rewards.
     */
    #[Optional]
    public ?string $nextMilestoneSuffix;

    /**
     * The maximum number of winners. Only applies to `LEADERBOARD` rewards. When `limitDuration` is `PER_MONTH`, this many top referrers win each month; otherwise this many win in total. Defaults to `3` when omitted.
     */
    #[Optional]
    public ?int $numberOfWinners;

    /**
     * The display order of the reward.
     */
    #[Optional]
    public ?int $order;

    /**
     * A legacy static coupon code shown to the referred friend in the reward-won email and webhook (double-sided rewards). Same caveats as `couponCode`.
     */
    #[Optional]
    public ?string $referralCouponCode;

    /**
     * The reward description shown to the referred friend (double-sided rewards).
     */
    #[Optional]
    public ?string $referralDescription;

    /**
     * For double-sided rewards, deliver the referred friend's reward upfront as a discount.
     */
    #[Optional]
    public ?bool $referredRewardUpfront;

    /**
     * Tax valuation for the referred friend's side of a double-sided reward. Defaults to not tax-reportable (a purchase rebate).
     */
    #[Optional]
    public ?RewardTaxValuation $referredValue;

    /**
     * The reward title (internal label).
     */
    #[Optional]
    public ?string $title;

    /**
     * Tax valuation for the reward (the referrer's side of a double-sided reward). Used by tax documentation / 1099 reporting.
     */
    #[Optional]
    public ?RewardTaxValuation $value;

    /**
     * `new RewardUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RewardUpdateParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RewardUpdateParams)->withID(...)
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
     * @param CommissionStructure|CommissionStructureShape|null $commissionStructure
     * @param LimitDuration|value-of<LimitDuration>|null $limitDuration
     * @param array<string,mixed> $metadata
     * @param RewardTaxValuation|RewardTaxValuationShape|null $referredValue
     * @param RewardTaxValuation|RewardTaxValuationShape|null $value
     */
    public static function with(
        string $id,
        CommissionStructure|array|null $commissionStructure = null,
        ?int $conversionsRequired = null,
        ?string $couponCode = null,
        ?string $description = null,
        ?string $imageURL = null,
        ?bool $isUnlimited = null,
        ?bool $isVisible = null,
        ?int $limit = null,
        LimitDuration|string|null $limitDuration = null,
        ?array $metadata = null,
        ?string $nextMilestonePrefix = null,
        ?string $nextMilestoneSuffix = null,
        ?int $numberOfWinners = null,
        ?int $order = null,
        ?string $referralCouponCode = null,
        ?string $referralDescription = null,
        ?bool $referredRewardUpfront = null,
        RewardTaxValuation|array|null $referredValue = null,
        ?string $title = null,
        RewardTaxValuation|array|null $value = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $commissionStructure && $self['commissionStructure'] = $commissionStructure;
        null !== $conversionsRequired && $self['conversionsRequired'] = $conversionsRequired;
        null !== $couponCode && $self['couponCode'] = $couponCode;
        null !== $description && $self['description'] = $description;
        null !== $imageURL && $self['imageURL'] = $imageURL;
        null !== $isUnlimited && $self['isUnlimited'] = $isUnlimited;
        null !== $isVisible && $self['isVisible'] = $isVisible;
        null !== $limit && $self['limit'] = $limit;
        null !== $limitDuration && $self['limitDuration'] = $limitDuration;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $nextMilestonePrefix && $self['nextMilestonePrefix'] = $nextMilestonePrefix;
        null !== $nextMilestoneSuffix && $self['nextMilestoneSuffix'] = $nextMilestoneSuffix;
        null !== $numberOfWinners && $self['numberOfWinners'] = $numberOfWinners;
        null !== $order && $self['order'] = $order;
        null !== $referralCouponCode && $self['referralCouponCode'] = $referralCouponCode;
        null !== $referralDescription && $self['referralDescription'] = $referralDescription;
        null !== $referredRewardUpfront && $self['referredRewardUpfront'] = $referredRewardUpfront;
        null !== $referredValue && $self['referredValue'] = $referredValue;
        null !== $title && $self['title'] = $title;
        null !== $value && $self['value'] = $value;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The affiliate commission structure (AFFILIATE rewards only).
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
     * The number of referrals required to earn the reward.
     */
    public function withConversionsRequired(int $conversionsRequired): self
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
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * An image URL for the reward.
     */
    public function withImageURL(?string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * Whether the reward can be earned an unlimited number of times. Defaults to `true`, except `MILESTONE` rewards, which can only be earned once.
     */
    public function withIsUnlimited(bool $isUnlimited): self
    {
        $self = clone $this;
        $self['isUnlimited'] = $isUnlimited;

        return $self;
    }

    /**
     * Whether the reward is enabled. When `false`, the reward is disabled: no longer awarded (including to participants who already earned it) and hidden from participants.
     */
    public function withIsVisible(bool $isVisible): self
    {
        $self = clone $this;
        $self['isVisible'] = $isVisible;

        return $self;
    }

    /**
     * The number of times a participant can earn the reward (overridden by `isUnlimited`).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * The window over which `limit` applies.
     *
     * @param LimitDuration|value-of<LimitDuration> $limitDuration
     */
    public function withLimitDuration(LimitDuration|string $limitDuration): self
    {
        $self = clone $this;
        $self['limitDuration'] = $limitDuration;

        return $self;
    }

    /**
     * Custom key/value metadata (single-level; values are stored as strings).
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
     * Text shown before a participant's referral count in milestone progress copy (e.g. "You are only"). Applies to `MILESTONE` rewards.
     */
    public function withNextMilestonePrefix(?string $nextMilestonePrefix): self
    {
        $self = clone $this;
        $self['nextMilestonePrefix'] = $nextMilestonePrefix;

        return $self;
    }

    /**
     * Text shown after a participant's referral count in milestone progress copy (e.g. "referrals away from your next reward!"). Applies to `MILESTONE` rewards.
     */
    public function withNextMilestoneSuffix(?string $nextMilestoneSuffix): self
    {
        $self = clone $this;
        $self['nextMilestoneSuffix'] = $nextMilestoneSuffix;

        return $self;
    }

    /**
     * The maximum number of winners. Only applies to `LEADERBOARD` rewards. When `limitDuration` is `PER_MONTH`, this many top referrers win each month; otherwise this many win in total. Defaults to `3` when omitted.
     */
    public function withNumberOfWinners(int $numberOfWinners): self
    {
        $self = clone $this;
        $self['numberOfWinners'] = $numberOfWinners;

        return $self;
    }

    /**
     * The display order of the reward.
     */
    public function withOrder(int $order): self
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
     * The reward description shown to the referred friend (double-sided rewards).
     */
    public function withReferralDescription(?string $referralDescription): self
    {
        $self = clone $this;
        $self['referralDescription'] = $referralDescription;

        return $self;
    }

    /**
     * For double-sided rewards, deliver the referred friend's reward upfront as a discount.
     */
    public function withReferredRewardUpfront(bool $referredRewardUpfront): self
    {
        $self = clone $this;
        $self['referredRewardUpfront'] = $referredRewardUpfront;

        return $self;
    }

    /**
     * Tax valuation for the referred friend's side of a double-sided reward. Defaults to not tax-reportable (a purchase rebate).
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
     * The reward title (internal label).
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Tax valuation for the reward (the referrer's side of a double-sided reward). Used by tax documentation / 1099 reporting.
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
