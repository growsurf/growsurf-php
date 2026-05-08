<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Campaign\Commission\CommissionApproveResponse;
use Growsurf\Campaign\Commission\CommissionDeleteResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface CommissionContract
{
    /**
     * @api
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
    ): CommissionDeleteResponse;

    /**
     * @api
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
    ): CommissionApproveResponse;
}
