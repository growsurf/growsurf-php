<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Campaign\CampaignRewardListResponse;
use Growsurf\Campaign\DeleteRewardResponse;
use Growsurf\Campaign\Reward;
use Growsurf\Campaign\RewardCreateParams;
use Growsurf\Campaign\RewardDeleteParams;
use Growsurf\Campaign\RewardUpdateParams;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface RewardsRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|RewardCreateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $rewardID path param: Program reward (`CampaignReward`) ID
     * @param array<string,mixed>|RewardUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Reward>
     *
     * @throws APIException
     */
    public function update(
        string $rewardID,
        array|RewardUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $rewardID path param: Program reward (`CampaignReward`) ID
     * @param array<string,mixed>|RewardDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeleteRewardResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $rewardID,
        array|RewardDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
