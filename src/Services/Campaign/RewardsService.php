<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\CampaignRewardListResponse;
use Growsurf\Campaign\CommissionStructure;
use Growsurf\Campaign\DeleteRewardResponse;
use Growsurf\Campaign\Reward;
use Growsurf\Campaign\RewardCreateParams\LimitDuration;
use Growsurf\Campaign\RewardCreateParams\Type;
use Growsurf\Campaign\RewardTaxValuation;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\RewardsContract;

/**
 * Campaign reward (`CampaignReward`) configuration.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type CommissionStructureShape from \Growsurf\Campaign\CommissionStructure
 * @phpstan-import-type RewardTaxValuationShape from \Growsurf\Campaign\RewardTaxValuation
 */
final class RewardsService implements RewardsContract
{
    /**
     * @api
     */
    public RewardsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RewardsRawService($client);
    }

    /**
     * @api
     *
     * Retrieves the list of a program's configured rewards (`CampaignReward`s), the same set embedded in the `rewards` array of the campaign response.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CampaignRewardListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates a new campaign reward (`CampaignReward`) with a server-generated ID. The reward type must be compatible with the program type (affiliate programs support only `AFFILIATE` rewards; referral programs support all other types). Enabling an active reward of a type automatically enables that reward type on the program.
     *
     * @param string $id path param: GrowSurf program ID
     * @param Type|value-of<Type> $type body param: The reward type. Immutable after creation.
     * @param CommissionStructure|CommissionStructureShape|null $commissionStructure body param: The affiliate commission structure (AFFILIATE rewards only)
     * @param int $conversionsRequired body param: The number of referrals required to earn the reward
     * @param string|null $couponCode body param: A legacy static coupon code shown to the referrer in the reward-won email and webhook. Display text only (GrowSurf does not create or validate it); superseded by a connected billing integration's issued coupon when one exists.
     * @param string $description body param: The reward description shown to the referrer
     * @param string|null $imageURL body param: An image URL for the reward
     * @param bool $isUnlimited body param: Whether the reward can be earned an unlimited number of times. Defaults to `true`, except `MILESTONE` rewards, which can only be earned once.
     * @param bool $isVisible body param: Whether the reward is enabled. When `false`, the reward is disabled: no longer awarded (including to participants who already earned it) and hidden from participants.
     * @param int $limit body param: The number of times a participant can earn the reward (overridden by `isUnlimited`)
     * @param LimitDuration|value-of<LimitDuration> $limitDuration body param: The window over which `limit` applies
     * @param array<string,mixed> $metadata body param: Custom key/value metadata (single-level; values are stored as strings)
     * @param string|null $nextMilestonePrefix body param: Text shown before a participant's referral count in milestone progress copy (e.g. "You are only"). Applies to `MILESTONE` rewards.
     * @param string|null $nextMilestoneSuffix body param: Text shown after a participant's referral count in milestone progress copy (e.g. "referrals away from your next reward!"). Applies to `MILESTONE` rewards.
     * @param int $numberOfWinners body param: The maximum number of winners. Only applies to `LEADERBOARD` rewards. When `limitDuration` is `PER_MONTH`, this many top referrers win each month; otherwise this many win in total. Defaults to `3` when omitted.
     * @param int $order body param: The display order of the reward
     * @param string|null $referralCouponCode body param: A legacy static coupon code shown to the referred friend in the reward-won email and webhook (double-sided rewards). Same caveats as `couponCode`.
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
    ): Reward {
        $params = Util::removeNulls(
            [
                'type' => $type,
                'commissionStructure' => $commissionStructure,
                'conversionsRequired' => $conversionsRequired,
                'couponCode' => $couponCode,
                'description' => $description,
                'imageURL' => $imageURL,
                'isUnlimited' => $isUnlimited,
                'isVisible' => $isVisible,
                'limit' => $limit,
                'limitDuration' => $limitDuration,
                'metadata' => $metadata,
                'nextMilestonePrefix' => $nextMilestonePrefix,
                'nextMilestoneSuffix' => $nextMilestoneSuffix,
                'numberOfWinners' => $numberOfWinners,
                'order' => $order,
                'referralCouponCode' => $referralCouponCode,
                'referralDescription' => $referralDescription,
                'referredRewardUpfront' => $referredRewardUpfront,
                'referredValue' => $referredValue,
                'title' => $title,
                'value' => $value,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates an existing campaign reward (`CampaignReward`). The reward `type` is immutable and cannot be changed.
     *
     * @param string $campaignRewardID path param: Campaign reward (`CampaignReward`) ID
     * @param string $id path param: GrowSurf program ID
     * @param CommissionStructure|CommissionStructureShape|null $commissionStructure body param: The affiliate commission structure (AFFILIATE rewards only)
     * @param int $conversionsRequired body param: The number of referrals required to earn the reward
     * @param string|null $couponCode body param: A legacy static coupon code shown to the referrer in the reward-won email and webhook. Display text only (GrowSurf does not create or validate it); superseded by a connected billing integration's issued coupon when one exists.
     * @param string $description body param: The reward description shown to the referrer
     * @param string|null $imageURL body param: An image URL for the reward
     * @param bool $isUnlimited body param: Whether the reward can be earned an unlimited number of times. Defaults to `true`, except `MILESTONE` rewards, which can only be earned once.
     * @param bool $isVisible body param: Whether the reward is enabled. When `false`, the reward is disabled: no longer awarded (including to participants who already earned it) and hidden from participants.
     * @param int $limit body param: The number of times a participant can earn the reward (overridden by `isUnlimited`)
     * @param \Growsurf\Campaign\RewardUpdateParams\LimitDuration|value-of<\Growsurf\Campaign\RewardUpdateParams\LimitDuration> $limitDuration body param: The window over which `limit` applies
     * @param array<string,mixed> $metadata body param: Custom key/value metadata (single-level; values are stored as strings)
     * @param string|null $nextMilestonePrefix body param: Text shown before a participant's referral count in milestone progress copy (e.g. "You are only"). Applies to `MILESTONE` rewards.
     * @param string|null $nextMilestoneSuffix body param: Text shown after a participant's referral count in milestone progress copy (e.g. "referrals away from your next reward!"). Applies to `MILESTONE` rewards.
     * @param int $numberOfWinners body param: The maximum number of winners. Only applies to `LEADERBOARD` rewards. When `limitDuration` is `PER_MONTH`, this many top referrers win each month; otherwise this many win in total. Defaults to `3` when omitted.
     * @param int $order body param: The display order of the reward
     * @param string|null $referralCouponCode body param: A legacy static coupon code shown to the referred friend in the reward-won email and webhook (double-sided rewards). Same caveats as `couponCode`.
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
    ): Reward {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'commissionStructure' => $commissionStructure,
                'conversionsRequired' => $conversionsRequired,
                'couponCode' => $couponCode,
                'description' => $description,
                'imageURL' => $imageURL,
                'isUnlimited' => $isUnlimited,
                'isVisible' => $isVisible,
                'limit' => $limit,
                'limitDuration' => $limitDuration,
                'metadata' => $metadata,
                'nextMilestonePrefix' => $nextMilestonePrefix,
                'nextMilestoneSuffix' => $nextMilestoneSuffix,
                'numberOfWinners' => $numberOfWinners,
                'order' => $order,
                'referralCouponCode' => $referralCouponCode,
                'referralDescription' => $referralDescription,
                'referredRewardUpfront' => $referredRewardUpfront,
                'referredValue' => $referredValue,
                'title' => $title,
                'value' => $value,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($campaignRewardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deletes a campaign reward (`CampaignReward`). The reward is deactivated, removed from the program's reward set, and any connected upfront-discount coupons are cleaned up.
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
    ): DeleteRewardResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($campaignRewardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
