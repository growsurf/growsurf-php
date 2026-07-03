<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Campaign\CampaignRewardListResponse;
use Growsurf\Campaign\CommissionStructure;
use Growsurf\Campaign\DeleteRewardResponse;
use Growsurf\Campaign\Reward;
use Growsurf\Campaign\RewardCreateParams\LimitDuration;
use Growsurf\Campaign\RewardCreateParams\Type;
use Growsurf\Campaign\RewardTaxValuation;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type CommissionStructureShape from \Growsurf\Campaign\CommissionStructure
 * @phpstan-import-type RewardTaxValuationShape from \Growsurf\Campaign\RewardTaxValuation
 */
interface RewardsContract
{
    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CampaignRewardListResponse;

    /**
     * @api
     *
     * @param string $id path param: GrowSurf program ID
     * @param Type|value-of<Type> $type body param: The reward type. Immutable after creation.
     * @param CommissionStructure|CommissionStructureShape|null $commissionStructure body param: The affiliate commission structure (AFFILIATE rewards only)
     * @param int $conversionsRequired body param: The number of referrals required to earn the reward
     * @param string|null $couponCode Body param
     * @param string $description body param: The reward description shown to the referrer
     * @param string|null $imageURL body param: An image URL for the reward
     * @param bool $isActive body param: Whether the reward is active (awardable)
     * @param bool $isUnlimited body param: Whether the reward can be earned an unlimited number of times
     * @param bool $isVisible body param: Whether the reward is visible
     * @param int $limit body param: The number of times a participant can earn the reward (overridden by `isUnlimited`)
     * @param LimitDuration|value-of<LimitDuration> $limitDuration body param: The window over which `limit` applies
     * @param array<string,mixed> $metadata body param: Custom key/value metadata (single-level; values are stored as strings)
     * @param string|null $nextMilestonePrefix Body param
     * @param string|null $nextMilestoneSuffix Body param
     * @param int $numberOfWinners body param: The maximum number of winners (LEADERBOARD rewards)
     * @param int $order body param: The display order of the reward
     * @param string|null $referralCouponCode Body param
     * @param string|null $referralDescription body param: The reward description shown to the referred friend (double-sided rewards)
     * @param bool $referredRewardUpfront body param: For double-sided rewards, deliver the referred friend's reward upfront as a discount
     * @param RewardTaxValuation|RewardTaxValuationShape|null $referredValue body param: Tax valuation for the referred friend's side of a double-sided reward. Defaults to not tax-reportable (a purchase rebate)
     * @param string $title body param: The reward title (internal label)
     * @param RewardTaxValuation|RewardTaxValuationShape|null $value body param: Tax valuation for the reward (the referrer's side of a double-sided reward). Used by tax documentation / 1099 reporting
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        Type|string $type,
        CommissionStructure|array|null $commissionStructure = null,
        ?int $conversionsRequired = null,
        ?string $couponCode = null,
        ?string $description = null,
        ?string $imageURL = null,
        ?bool $isActive = null,
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
        RequestOptions|array|null $requestOptions = null,
    ): Reward;

    /**
     * @api
     *
     * @param string $campaignRewardID path param: Campaign reward (`CampaignReward`) ID
     * @param string $id path param: GrowSurf program ID
     * @param CommissionStructure|CommissionStructureShape|null $commissionStructure body param: The affiliate commission structure (AFFILIATE rewards only)
     * @param int $conversionsRequired body param: The number of referrals required to earn the reward
     * @param string|null $couponCode Body param
     * @param string $description body param: The reward description shown to the referrer
     * @param string|null $imageURL body param: An image URL for the reward
     * @param bool $isActive body param: Whether the reward is active (awardable)
     * @param bool $isUnlimited body param: Whether the reward can be earned an unlimited number of times
     * @param bool $isVisible body param: Whether the reward is visible
     * @param int $limit body param: The number of times a participant can earn the reward (overridden by `isUnlimited`)
     * @param \Growsurf\Campaign\RewardUpdateParams\LimitDuration|value-of<\Growsurf\Campaign\RewardUpdateParams\LimitDuration> $limitDuration body param: The window over which `limit` applies
     * @param array<string,mixed> $metadata body param: Custom key/value metadata (single-level; values are stored as strings)
     * @param string|null $nextMilestonePrefix Body param
     * @param string|null $nextMilestoneSuffix Body param
     * @param int $numberOfWinners body param: The maximum number of winners (LEADERBOARD rewards)
     * @param int $order body param: The display order of the reward
     * @param string|null $referralCouponCode Body param
     * @param string|null $referralDescription body param: The reward description shown to the referred friend (double-sided rewards)
     * @param bool $referredRewardUpfront body param: For double-sided rewards, deliver the referred friend's reward upfront as a discount
     * @param RewardTaxValuation|RewardTaxValuationShape|null $referredValue body param: Tax valuation for the referred friend's side of a double-sided reward. Defaults to not tax-reportable (a purchase rebate)
     * @param string $title body param: The reward title (internal label)
     * @param RewardTaxValuation|RewardTaxValuationShape|null $value body param: Tax valuation for the reward (the referrer's side of a double-sided reward). Used by tax documentation / 1099 reporting
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $campaignRewardID,
        string $id,
        CommissionStructure|array|null $commissionStructure = null,
        ?int $conversionsRequired = null,
        ?string $couponCode = null,
        ?string $description = null,
        ?string $imageURL = null,
        ?bool $isActive = null,
        ?bool $isUnlimited = null,
        ?bool $isVisible = null,
        ?int $limit = null,
        \Growsurf\Campaign\RewardUpdateParams\LimitDuration|string|null $limitDuration = null,
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
        RequestOptions|array|null $requestOptions = null,
    ): Reward;

    /**
     * @api
     *
     * @param string $campaignRewardID path param: Campaign reward (`CampaignReward`) ID
     * @param string $id path param: GrowSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $campaignRewardID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): DeleteRewardResponse;
}
