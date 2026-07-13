<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts;

use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\Team\RotateApiKeyResponse;
use Growsurf\Team\Team;
use Growsurf\Team\VerificationEmailResponse;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface TeamContract
{
    /**
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): Team;

    /**
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $name,
        RequestOptions|array|null $requestOptions = null,
    ): Team;

    /**
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotateApiKey(
        RequestOptions|array|null $requestOptions = null
    ): RotateApiKeyResponse;

    /**
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function requestVerification(
        RequestOptions|array|null $requestOptions = null
    ): Team;

    /**
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function resendOwnerVerificationEmail(
        RequestOptions|array|null $requestOptions = null
    ): VerificationEmailResponse;
}
