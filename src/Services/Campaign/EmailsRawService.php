<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Conversion\MapOf;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\EmailsRawContract;

/**
 * Campaign emails (`CampaignEmails`) configuration — the dashboard Program Editor's **Emails** tab.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class EmailsRawService implements EmailsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves a program's email configuration — the same surface as the dashboard Program Editor's **Emails** tab. Returns each editable email template (`subject`, `preheader`, `body`, `isEnabled`) plus the `settings` block (sender, contact, and design). The set of email templates returned depends on the program type (referral vs affiliate).
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/emails', $id],
            options: $requestOptions,
            convert: new MapOf('mixed'),
        );
    }

    /**
     * @api
     *
     * Updates a program's email configuration. Only the fields you send are changed; omitted fields are left untouched. You may only write the email templates the dashboard exposes for the program type — writing a template that is not available for the program type returns a `400`. Some fields are read-only (`settings.sender.fromEmail`, whose custom value requires dashboard domain verification).
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $body partial `CampaignEmails` (see API reference)
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array $body = [],
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['campaign/%1$s/emails', $id],
            body: (object) $body,
            options: $requestOptions,
            convert: new MapOf('mixed'),
        );
    }
}
