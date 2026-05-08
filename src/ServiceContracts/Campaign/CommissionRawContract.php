<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Campaign\Commission\CommissionApproveParams;
use Growsurf\Campaign\Commission\CommissionApproveResponse;
use Growsurf\Campaign\Commission\CommissionDeleteParams;
use Growsurf\Campaign\Commission\CommissionDeleteResponse;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface CommissionRawContract
{
    /**
     * @api
     *
     * @param string $commissionID participant commission ID
     * @param array<string,mixed>|CommissionDeleteParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $commissionID participant commission ID
     * @param array<string,mixed>|CommissionApproveParams $params
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
    ): BaseResponse;
}
