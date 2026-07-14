<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\Commission\CommissionApproveResponse;
use Growsurf\Campaign\Commission\CommissionDeleteResponse;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\CommissionContract;

/**
 * Affiliate transaction, commission, and payout operations.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class CommissionService implements CommissionContract
{
    /**
     * @api
     */
    public CommissionRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CommissionRawService($client);
    }

    /**
     * @api
     *
     * **Affiliate programs only.** Removes a pending participant commission.
     *
     * @param string $commissionID participant commission ID
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $commissionID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): CommissionDeleteResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($commissionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * **Affiliate programs only.** Approves a pending participant commission so it can become eligible for payout.
     *
     * @param string $commissionID participant commission ID
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $commissionID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): CommissionApproveResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($commissionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
