<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\CampaignRewardListResponse;
use Growsurf\Campaign\CommissionStructure;
use Growsurf\Campaign\DeleteRewardResponse;
use Growsurf\Campaign\Reward;
use Growsurf\Campaign\RewardCreateParams;
use Growsurf\Campaign\RewardCreateParams\LimitDuration;
use Growsurf\Campaign\RewardCreateParams\Type;
use Growsurf\Campaign\RewardDeleteParams;
use Growsurf\Campaign\RewardTaxValuation;
use Growsurf\Campaign\RewardUpdateParams;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\RewardsRawContract;

/**
 * Campaign reward (`CampaignReward`) configuration.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type CommissionStructureShape from \Growsurf\Campaign\CommissionStructure
 * @phpstan-import-type RewardTaxValuationShape from \Growsurf\Campaign\RewardTaxValuation
 */
final class RewardsRawService implements RewardsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves the list of a program's configured rewards (`CampaignReward`s) — the same set embedded in the `rewards` array of the campaign response. Delete a reward with `DELETE /campaign/{id}/reward-configs/{campaignRewardId}`.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CampaignRewardListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/reward-configs', $id],
            options: $requestOptions,
            convert: CampaignRewardListResponse::class,
        );
    }

    /**
     * @api
     *
     * Creates a new campaign reward (`CampaignReward`) with a GrowSurf-assigned ID. The reward type must be compatible with the program type (affiliate programs support only `AFFILIATE` rewards; referral programs support all other types). Enabling an active reward of a type automatically enables that reward type on the program.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   type: Type|value-of<Type>,
     *   commissionStructure?: CommissionStructure|CommissionStructureShape,
     *   conversionsRequired?: int,
     *   couponCode?: string,
     *   description?: string,
     *   imageURL?: string,
     *   isUnlimited?: bool,
     *   isVisible?: bool,
     *   limit?: int,
     *   limitDuration?: LimitDuration|value-of<LimitDuration>,
     *   metadata?: array<string,mixed>,
     *   nextMilestonePrefix?: string,
     *   nextMilestoneSuffix?: string,
     *   numberOfWinners?: int,
     *   order?: int,
     *   referralCouponCode?: string,
     *   referralDescription?: string,
     *   referredRewardUpfront?: bool,
     *   referredValue?: RewardTaxValuation|RewardTaxValuationShape,
     *   title?: string,
     *   value?: RewardTaxValuation|RewardTaxValuationShape,
     * }|RewardCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Reward>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|RewardCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RewardCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/reward-configs', $id],
            body: (object) $parsed,
            options: $options,
            convert: Reward::class,
        );
    }

    /**
     * @api
     *
     * Updates an existing campaign reward (`CampaignReward`). The reward `type` is immutable and cannot be changed. When the update replaces `metadata`, renamed keys automatically rewrite any `{{campaignReward[…]}}` references in campaign copy; removing a key that campaign copy still references returns a `409` listing the referencing fields.
     *
     * @param string $campaignRewardID path param: Campaign reward (`CampaignReward`) ID
     * @param array{
     *   id: string,
     *   commissionStructure?: CommissionStructure|CommissionStructureShape,
     *   conversionsRequired?: int,
     *   couponCode?: string,
     *   description?: string,
     *   imageURL?: string,
     *   isUnlimited?: bool,
     *   isVisible?: bool,
     *   limit?: int,
     *   limitDuration?: RewardUpdateParams\LimitDuration|value-of<RewardUpdateParams\LimitDuration>,
     *   metadata?: array<string,mixed>,
     *   nextMilestonePrefix?: string,
     *   nextMilestoneSuffix?: string,
     *   numberOfWinners?: int,
     *   order?: int,
     *   referralCouponCode?: string,
     *   referralDescription?: string,
     *   referredRewardUpfront?: bool,
     *   referredValue?: RewardTaxValuation|RewardTaxValuationShape,
     *   title?: string,
     *   value?: RewardTaxValuation|RewardTaxValuationShape,
     * }|RewardUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Reward>
     *
     * @throws APIException
     */
    public function update(
        string $campaignRewardID,
        array|RewardUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RewardUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['campaign/%1$s/reward-configs/%2$s', $id, $campaignRewardID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: Reward::class,
        );
    }

    /**
     * @api
     *
     * Deletes a campaign reward (`CampaignReward`). The reward is deactivated, removed from the program's reward set, and any connected upfront-discount coupons are cleaned up. If campaign copy still references any of the reward's metadata keys via `{{campaignReward[…]}}` tokens, the delete returns a `409` listing the referencing fields — update those fields first.
     *
     * @param string $campaignRewardID path param: Campaign reward (`CampaignReward`) ID
     * @param array{id: string}|RewardDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeleteRewardResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $campaignRewardID,
        array|RewardDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RewardDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['campaign/%1$s/reward-configs/%2$s', $id, $campaignRewardID],
            options: $options,
            convert: DeleteRewardResponse::class,
        );
    }
}
