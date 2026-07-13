<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts;

use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\Team\RotateApiKeyResponse;
use Growsurf\Team\Team;
use Growsurf\Team\TeamUpdateParams;
use Growsurf\Team\VerificationEmailResponse;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface TeamRawContract
{
    /**
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @param array<string,mixed>|TeamUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function update(
        array|TeamUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function requestVerification(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VerificationEmailResponse>
     *
     * @throws APIException
     */
    public function resendOwnerVerificationEmail(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
