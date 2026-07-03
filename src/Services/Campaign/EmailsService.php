<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\EmailsContract;

/**
 * Campaign emails (`CampaignEmails`) configuration — the dashboard Program Editor's **Emails** tab.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class EmailsService implements EmailsContract
{
    /**
     * @api
     */
    public EmailsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EmailsRawService($client);
    }

    /**
     * @api
     *
     * Retrieves a program's email configuration — the same surface as the dashboard Program Editor's **Emails** tab. Returns each editable email template plus the `settings` block; the set of templates returned depends on the program type. See the API reference for the full field list.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return array<string,mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates a program's email configuration. Only the fields you send are changed (a surgical merge); omitted fields are left untouched. You may only write the email templates the dashboard exposes for the program type; some fields are read-only. See the API reference for the full field list.
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $body partial `CampaignEmails` (see API reference)
     * @param RequestOpts|null $requestOptions
     *
     * @return array<string,mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array $body = [],
        RequestOptions|array|null $requestOptions = null,
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, body: $body, requestOptions: $requestOptions);

        return $response->parse();
    }
}
