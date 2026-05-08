<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Campaign\Reward\RewardApproveResponse;
use Growsurf\Campaign\Reward\RewardDeleteResponse;
use Growsurf\Campaign\Reward\RewardFulfillResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface RewardContract
{
    /**
     * @api
     *
     * @param string $rewardID participant reward ID
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $rewardID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): RewardDeleteResponse;

    /**
     * @api
     *
     * @param string $rewardID path param: Participant reward ID
     * @param string $id path param: GrowSurf program ID
     * @param bool $fulfill body param: Set true to mark the reward as fulfilled after approval
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $rewardID,
        string $id,
        ?bool $fulfill = null,
        RequestOptions|array|null $requestOptions = null,
    ): RewardApproveResponse;

    /**
     * @api
     *
     * @param string $rewardID participant reward ID
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function fulfill(
        string $rewardID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): RewardFulfillResponse;
}
