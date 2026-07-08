<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Account\Account;
use Growsurf\Account\AccountCreateParams;
use Growsurf\Account\AccountUpdateParams;
use Growsurf\Account\CreateAccountResponse;
use Growsurf\Account\RotateApiKeyResponse;
use Growsurf\Account\VerificationEmailResponse;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\AccountRawContract;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class AccountRawService implements AccountRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new GrowSurf account. This is the only endpoint that does not require an API key. The response includes an API key for the new account, but the key is locked until the account's email address is verified: authenticated endpoints outside the `Accounts` group return a `403` with error code `EMAIL_NOT_VERIFIED_ERROR` until then (resend the email via `POST /account/verification-email`, then retry). A welcome email is sent to the address with the verification link and a set-password link for dashboard access. Accounts whose email is never verified are deleted automatically after 7 days. For security, the API key is rotated the first time the account owner signs in to the GrowSurf dashboard. Some actions (such as emailing participants) additionally require the GrowSurf team to verify the account first. By creating an account you agree, on behalf of the account holder, to GrowSurf's [Terms of Service](https://growsurf.com/terms) and [Privacy Policy](https://growsurf.com/privacy).
     *
     * @param array{
     *   email: string,
     *   company?: string,
     *   firstName?: string,
     *   lastName?: string,
     * }|AccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreateAccountResponse>
     *
     * @throws APIException
     */
    public function create(
        array|AccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'accounts',
            body: (object) $parsed,
            options: $options,
            convert: CreateAccountResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieves the account that owns the API key: profile and GrowSurf-team verification state.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'account',
            options: $requestOptions,
            convert: Account::class,
        );
    }

    /**
     * @api
     *
     * Updates your own account profile (`firstName`, `lastName`, `company`). Any other property is rejected with a `400` — in particular, the account `email` cannot be changed via the API, and billing/subscription is not editable here.
     *
     * @param array{
     *   company?: string,
     *   firstName?: string,
     *   lastName?: string,
     * }|AccountUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function update(
        array|AccountUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: 'account',
            body: (object) $parsed,
            options: $options,
            convert: Account::class,
        );
    }

    /**
     * @api
     *
     * Generates a new API key and immediately revokes the old one. The key used to make this request stops working as soon as the response is returned — update every integration that used the old key with the new one. The account owner is notified by email whenever the key is rotated.
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
            path: 'account/api-key',
            options: $requestOptions,
            convert: RotateApiKeyResponse::class,
        );
    }

    /**
     * @api
     *
     * Requests GrowSurf-team verification of your account (required before a program can email its participants). Idempotent — calling it again while a request is pending does not create a duplicate. Returns the account with its updated `verificationStatus`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function requestVerification(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'account/verification-request',
            options: $requestOptions,
            convert: Account::class,
        );
    }

    /**
     * @api
     *
     * Resends the email-verification email to the account's email address. A `200` with `status: SENT` is only returned when an email was actually dispatched. Returns a `400` if the email is already verified, or a `429` if a verification email was sent too recently — wait a moment, then retry.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VerificationEmailResponse>
     *
     * @throws APIException
     */
    public function resendVerificationEmail(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'account/verification-email',
            options: $requestOptions,
            convert: VerificationEmailResponse::class,
        );
    }
}
