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
     * Retrieves the team bound to the API key or OAuth connection. `verificationStatus` is `VERIFIED` once GrowSurf has verified the team, which is required before a program can send participant emails. A credential that can act across multiple teams cannot use this operation because it has no single Team resource.
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
     * Generates a new API key and makes the key used on this request stop working when rotation succeeds. The SDK sends a retry-safe `Idempotency-Key`; store the returned API key, then update every integration that used the old key. This operation is available only through the REST API or a GrowSurf API SDK, not through MCP.
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
     * Requests GrowSurf to verify the bound team. Calling it again while a request is pending does not create a duplicate.
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
     * Resends the email-verification message to the bound team's owner. The response never reveals the owner's email address.
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
