<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts;

use Growsurf\Account\Account;
use Growsurf\Account\AccountCreateParams;
use Growsurf\Account\AccountUpdateParams;
use Growsurf\Account\CreateAccountResponse;
use Growsurf\Account\RotateApiKeyResponse;
use Growsurf\Account\VerificationEmailResponse;
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

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AccountUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function update(
        array|AccountUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RotateApiKeyResponse>
     *
     * @throws APIException
     */
    public function rotateApiKey(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function requestVerification(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VerificationEmailResponse>
     *
     * @throws APIException
     */
    public function resendVerificationEmail(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
