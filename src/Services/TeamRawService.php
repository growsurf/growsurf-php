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
     * Retrieves the team bound to the API key or OAuth connection. `verificationStatus` is `VERIFIED` once GrowSurf has verified the team, which is required before a program can send participant emails.
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
     * Updates the name of the team bound to the API key or OAuth connection. Any other property is rejected with a `400`. Personal profiles, billing, and team ownership are not editable here.
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
     * Generates a new API key and makes the key used on this request stop working when rotation succeeds. Send a unique, random `Idempotency-Key`. If the response is interrupted, immediately retry with the original API key and the same `Idempotency-Key` to receive the same new key. Update every integration that used the old key. The team owner is notified by email whenever the key is rotated. GrowSurf SDKs generate the idempotency key automatically. This endpoint accepts an API key with `api_key:rotate`. If this scope is unavailable, rotate the key in the authenticated dashboard instead. This operation is available only through the REST API or a GrowSurf API SDK, not through MCP.
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
     * Requests GrowSurf to verify the bound team (required before a program can email its participants). Idempotent — calling it again while a request is pending does not create a duplicate. Returns the team with its updated `verificationStatus`.
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
     * Resends the email-verification message to the bound team's owner. The response never reveals the owner's email address. A `200` with `status: SENT` is returned only when an email was actually dispatched. Returns `400` if the email is already verified, and `429` if a verification email was sent too recently — wait a moment, then retry.
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
