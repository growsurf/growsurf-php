<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Account\AccountCreateParams;
use Growsurf\Account\CreateAccountResponse;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\AccountRawContract;

/**
 * Create a GrowSurf account and its initial API key.
 *
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
     * Creates a new GrowSurf account. This is the only endpoint that does not require an API key. The response includes an API key for the new account, shown once in the response. The key is locked until the team owner's email address is verified: authenticated program and resource endpoints return a `403` with error code `EMAIL_NOT_VERIFIED_ERROR` until then (resend the email via `POST /team/owner/verification-email`, then retry). A welcome email is sent to the address with the verification link and a set-password link for dashboard access. Accounts whose email is never verified are deleted automatically after 7 days. For security, the API key is rotated the first time the account owner signs in to the GrowSurf dashboard. Some actions (such as emailing participants) additionally require GrowSurf to verify the team first. By creating an account you agree, on behalf of the account holder, to GrowSurf's [Terms of Service](https://growsurf.com/terms) and [Privacy Policy](https://growsurf.com/privacy).
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
            headers: ['Authorization' => null],
            body: (object) $parsed,
            options: $options,
            convert: CreateAccountResponse::class,
        );
    }
}
