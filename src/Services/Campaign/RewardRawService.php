<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\Reward\RewardApproveParams;
use Growsurf\Campaign\Reward\RewardApproveResponse;
use Growsurf\Campaign\Reward\RewardDeleteParams;
use Growsurf\Campaign\Reward\RewardDeleteResponse;
use Growsurf\Campaign\Reward\RewardFulfillParams;
use Growsurf\Campaign\Reward\RewardFulfillResponse;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\RewardRawContract;

/**
 * Participant reward retrieval and manual reward operations.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class RewardRawService implements RewardRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Removes a manually approved participant reward that has not already been approved.
     *
     * @param string $rewardID participant reward ID
     * @param array{id: string}|RewardDeleteParams $params
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
            path: ['campaign/%1$s/reward/%2$s', $id, $rewardID],
            options: $options,
            convert: RewardDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Approves a manually approved reward earned by a participant. Requires `reward:write`. Passing `fulfill: true` also requires `reward:fulfill`.
     *
     * @param string $rewardID path param: Participant reward ID
     * @param array{id: string, fulfill?: bool}|RewardApproveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = RewardApproveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/reward/%2$s/approve', $id, $rewardID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: RewardApproveResponse::class,
        );
    }

    /**
     * @api
     *
     * Marks an approved participant reward as fulfilled. Requires `reward:fulfill`.
     *
     * @param string $rewardID participant reward ID
     * @param array{id: string}|RewardFulfillParams $params
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
    ): BaseResponse {
        [$parsed, $options] = RewardFulfillParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/reward/%2$s/fulfill', $id, $rewardID],
            options: $options,
            convert: RewardFulfillResponse::class,
        );
    }
}
