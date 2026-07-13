<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\TeamRawContract;
use Growsurf\Team\RotateApiKeyResponse;
use Growsurf\Team\Team;
use Growsurf\Team\TeamUpdateParams;
use Growsurf\Team\VerificationEmailResponse;

/**
 * Operations for the team bound to the API key or OAuth connection.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class TeamRawService implements TeamRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'team',
            options: $requestOptions,
            convert: Team::class,
        );
    }

    /**
     * @api
     *
     * @param array{name: string}|TeamUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function update(
        array|TeamUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TeamUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: 'team',
            body: (object) $parsed,
            options: $options,
            convert: Team::class,
        );
    }

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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api-key/rotate',
            options: $requestOptions,
            convert: RotateApiKeyResponse::class,
        );
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function requestVerification(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'team/verification-request',
            options: $requestOptions,
            convert: Team::class,
        );
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VerificationEmailResponse>
     *
     * @throws APIException
     */
    public function resendOwnerVerificationEmail(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'team/owner/verification-email',
            options: $requestOptions,
            convert: VerificationEmailResponse::class,
        );
    }
}
