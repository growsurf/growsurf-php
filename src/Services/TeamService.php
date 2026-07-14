<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\TeamContract;
use Growsurf\Team\RotateApiKeyResponse;
use Growsurf\Team\Team;
use Growsurf\Team\VerificationEmailResponse;

/**
 * Operations for the team bound to the API key or OAuth connection.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class TeamService implements TeamContract
{
    /**
     * @api
     */
    public TeamRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TeamRawService($client);
    }

    /**
     * @api
     *
     * Retrieves the team bound to the API key or OAuth connection. `verificationStatus` is `VERIFIED` once GrowSurf has verified the team, which is required before a program can send participant emails.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): Team {
        return $this->raw->retrieve(requestOptions: $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Updates the name of the team bound to the API key or OAuth connection. Any other property is rejected with a `400`. Personal profiles, billing, and team ownership are not editable here.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $name,
        RequestOptions|array|null $requestOptions = null,
    ): Team {
        // @phpstan-ignore-next-line argument.type
        return $this->raw->update(
            params: ['name' => $name],
            requestOptions: $requestOptions,
        )->parse();
    }

    /**
     * @api
     *
     * Generates a new API key and makes the key used on this request stop working when rotation succeeds. Send a unique, random `Idempotency-Key`. If the response is interrupted, immediately retry with the original API key and the same `Idempotency-Key` to receive the same new key. Update every integration that used the old key. The team owner is notified by email whenever the key is rotated. GrowSurf SDKs generate the idempotency key automatically. This endpoint accepts an API key with `api_key:rotate`. If this scope is unavailable, rotate the key in the authenticated dashboard instead. This operation is available only through the REST API or a GrowSurf API SDK, not through MCP.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotateApiKey(
        RequestOptions|array|null $requestOptions = null
    ): RotateApiKeyResponse {
        return $this->raw->rotateApiKey(requestOptions: $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Requests GrowSurf to verify the bound team (required before a program can email its participants). Idempotent — calling it again while a request is pending does not create a duplicate. Returns the team with its updated `verificationStatus`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function requestVerification(
        RequestOptions|array|null $requestOptions = null
    ): Team {
        return $this->raw->requestVerification(requestOptions: $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Resends the email-verification message to the bound team's owner. The response never reveals the owner's email address. A `200` with `status: SENT` is returned only when an email was actually dispatched. Returns `400` if the email is already verified, and `429` if a verification email was sent too recently — wait a moment, then retry.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function resendOwnerVerificationEmail(
        RequestOptions|array|null $requestOptions = null
    ): VerificationEmailResponse {
        return $this->raw->resendOwnerVerificationEmail(
            requestOptions: $requestOptions
        )->parse();
    }
}
