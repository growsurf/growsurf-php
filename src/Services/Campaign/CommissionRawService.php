<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\Commission\CommissionApproveParams;
use Growsurf\Campaign\Commission\CommissionApproveResponse;
use Growsurf\Campaign\Commission\CommissionDeleteParams;
use Growsurf\Campaign\Commission\CommissionDeleteResponse;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\CommissionRawContract;

/**
 * Affiliate transaction, commission, and payout operations.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class CommissionRawService implements CommissionRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * **Affiliate programs only.** Removes a pending participant commission.
     *
     * @param string $commissionID participant commission ID
     * @param array{id: string}|CommissionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CommissionDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $commissionID,
        array|CommissionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CommissionDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['campaign/%1$s/commission/%2$s', $id, $commissionID],
            options: $options,
            convert: CommissionDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * **Affiliate programs only.** Approves a pending participant commission so it can become eligible for payout.
     *
     * @param string $commissionID participant commission ID
     * @param array{id: string}|CommissionApproveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CommissionApproveResponse>
     *
     * @throws APIException
     */
    public function approve(
        string $commissionID,
        array|CommissionApproveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CommissionApproveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/commission/%2$s/approve', $id, $commissionID],
            options: $options,
            convert: CommissionApproveResponse::class,
        );
    }
}
