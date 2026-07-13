<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts;

use Growsurf\Account\CreateAccountResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface AccountContract
{
    /**
     * @api
     *
     * @param string $company Body param
     * @param string $firstName Body param
     * @param string $lastName Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $email,
        ?string $company = null,
        ?string $firstName = null,
        ?string $lastName = null,
        RequestOptions|array|null $requestOptions = null,
    ): CreateAccountResponse;
}
