<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\Reward\RewardApproveResponse;
use Growsurf\Campaign\Reward\RewardDeleteResponse;
use Growsurf\Campaign\Reward\RewardFulfillResponse;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\RewardContract;

/**
 * Participant reward retrieval and manual reward operations.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class RewardService implements RewardContract
{
    /**
     * @api
     */
    public RewardRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RewardRawService($client);
    }

    /**
     * @api
     *
     * Removes a manually approved participant reward that has not already been approved.
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
    ): RewardDeleteResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($rewardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Approves a manually approved reward earned by a participant. Requires `reward:write`. Passing `fulfill: true` also requires `reward:fulfill`.
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
    ): RewardApproveResponse {
        $params = Util::removeNulls(['id' => $id, 'fulfill' => $fulfill]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($rewardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Marks an approved participant reward as fulfilled. Requires `reward:fulfill`.
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
    ): RewardFulfillResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->fulfill($rewardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
