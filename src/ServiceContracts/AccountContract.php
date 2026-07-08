<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts;

use Growsurf\Account\Account;
use Growsurf\Account\CreateAccountResponse;
use Growsurf\Account\RotateApiKeyResponse;
use Growsurf\Account\VerificationEmailResponse;
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

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): Account;

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
    public function update(
        ?string $company = null,
        ?string $firstName = null,
        ?string $lastName = null,
        RequestOptions|array|null $requestOptions = null,
    ): Account;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotateApiKey(
        RequestOptions|array|null $requestOptions = null
    ): RotateApiKeyResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function requestVerification(
        RequestOptions|array|null $requestOptions = null
    ): Account;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function resendVerificationEmail(
        RequestOptions|array|null $requestOptions = null
    ): VerificationEmailResponse;
}
