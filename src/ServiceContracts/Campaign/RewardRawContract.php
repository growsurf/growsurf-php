<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Campaign\Reward\RewardApproveParams;
use Growsurf\Campaign\Reward\RewardApproveResponse;
use Growsurf\Campaign\Reward\RewardDeleteParams;
use Growsurf\Campaign\Reward\RewardDeleteResponse;
use Growsurf\Campaign\Reward\RewardFulfillParams;
use Growsurf\Campaign\Reward\RewardFulfillResponse;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface RewardRawContract
{
    /**
     * @api
     *
     * @param string $rewardID participant reward ID
     * @param array<string,mixed>|RewardDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RewardDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $rewardID,
        array|RewardDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $rewardID path param: Participant reward ID
     * @param array<string,mixed>|RewardApproveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RewardApproveResponse>
     *
     * @throws APIException
     */
    public function approve(
        string $rewardID,
        array|RewardApproveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $rewardID participant reward ID
     * @param array<string,mixed>|RewardFulfillParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RewardFulfillResponse>
     *
     * @throws APIException
     */
    public function fulfill(
        string $rewardID,
        array|RewardFulfillParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
