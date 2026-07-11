<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Account\Account;
use Growsurf\Account\CreateAccountResponse;
use Growsurf\Account\RotateApiKeyResponse;
use Growsurf\Account\VerificationEmailResponse;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\AccountContract;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class AccountService implements AccountContract
{
    /**
     * @api
     */
    public AccountRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountRawService($client);
    }

    /**
     * @api
     *
     * Creates a new GrowSurf account. This is the only endpoint that does not require an API key. The response includes an API key for the new account, shown once in the response. The key is locked until the account's email address is verified: authenticated endpoints outside the `Accounts` group return a `403` with error code `EMAIL_NOT_VERIFIED_ERROR` until then (resend the email via `POST /account/verification-email`, then retry). A welcome email is sent to the address with the verification link and a set-password link for dashboard access. Accounts whose email is never verified are deleted automatically after 7 days. For security, the API key is rotated the first time the account owner signs in to the GrowSurf dashboard. Some actions (such as emailing participants) additionally require the GrowSurf team to verify the account first. By creating an account you agree, on behalf of the account holder, to GrowSurf's [Terms of Service](https://growsurf.com/terms) and [Privacy Policy](https://growsurf.com/privacy).
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
    ): CreateAccountResponse {
        $params = Util::removeNulls(
            [
                'email' => $email,
                'company' => $company,
                'firstName' => $firstName,
                'lastName' => $lastName,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves the account that owns the API key: profile and GrowSurf-team verification state. `verificationStatus` is `VERIFIED` once the GrowSurf team has verified the account — this is required before you can send participant emails from a program.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): Account {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates your own account profile (`firstName`, `lastName`, `company`). Any other property is rejected with a `400` — in particular, the account `email` cannot be changed via the API, and billing/subscription is not editable here.
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
    ): Account {
        $params = Util::removeNulls(
            [
                'company' => $company,
                'firstName' => $firstName,
                'lastName' => $lastName,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Generates a new API key and invalidates the key used for the request. The SDK sends a retry-safe `Idempotency-Key`, so automatic retries return the same replacement. Store the returned key, then update every integration that used the old key. The account owner is notified by email whenever the key is rotated. Requires an API key with `api_key:rotate`. This operation is available only through the REST API or a GrowSurf API SDK, not through MCP.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotateApiKey(
        RequestOptions|array|null $requestOptions = null
    ): RotateApiKeyResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->rotateApiKey(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Requests GrowSurf-team verification of your account (required before a program can email its participants). Idempotent — calling it again while a request is pending does not create a duplicate. Returns the account with its updated `verificationStatus`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function requestVerification(
        RequestOptions|array|null $requestOptions = null
    ): Account {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->requestVerification(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Resends the email-verification email to the account's email address. A `200` with `status: SENT` is only returned when an email was actually dispatched. Returns a `400` if the email is already verified, or a `429` if a verification email was sent too recently — wait a moment, then retry.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function resendVerificationEmail(
        RequestOptions|array|null $requestOptions = null
    ): VerificationEmailResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->resendVerificationEmail(requestOptions: $requestOptions);

        return $response->parse();
    }
}
