<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Account\CreateAccountResponse;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\AccountContract;

/**
 * Create a GrowSurf account and its initial API key.
 *
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
     * Creates a new GrowSurf account. This is the only endpoint that does not require an API key. Before calling it, an authorized account owner must review and approve GrowSurf's [Terms of Service](https://growsurf.com/terms) and [Privacy Policy](https://growsurf.com/privacy). The account starts a 14-day Business trial without a credit card. The response includes an API key for the new account, shown once in the response. The key is a secret: store it in a secret manager and do not put it in logs, screenshots, URLs, model context, analytics, or generated output. The key is locked until the team owner's email address is verified: authenticated program and resource endpoints return a `403` with error code `EMAIL_NOT_VERIFIED_ERROR` until then (resend the email via `POST /team/owner/verification-email`, then retry). Verification unlocks this same key - keep it and retry rather than requesting a replacement. A welcome email is sent to the address with the verification link and a set-password link for dashboard access. Accounts whose email is never verified are deleted automatically after 7 days. Separately, for security, the API key is replaced the first time the account owner signs in to the GrowSurf dashboard; email verification does not trigger that, and the previous key then returns a `403` with error code `NOT_AUTHORIZED_ERROR`. Some actions (such as emailing participants) additionally require GrowSurf to verify the team first. Calling this endpoint accepts those policies on the account holder's behalf.
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
}
