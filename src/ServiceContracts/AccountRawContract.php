<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts;

use Growsurf\Account\AccountCreateParams;
use Growsurf\Account\CreateAccountResponse;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface AccountRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreateAccountResponse>
     *
     * @throws APIException
     */
    public function create(
        array|AccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
