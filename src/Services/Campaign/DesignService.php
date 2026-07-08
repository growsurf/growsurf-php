<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\DesignContract;

/**
 * Campaign design (`CampaignDesign`) configuration — the dashboard Program Editor's **Design** tab.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class DesignService implements DesignContract
{
    /**
     * @api
     */
    public DesignRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DesignRawService($client);
    }

    /**
     * @api
     *
     * Retrieves a program's design configuration — the same surface as the dashboard Program Editor's **Design** tab. This is a large object whose available fields depend on the program type; the response includes every field and its current value, which is the same shape you send back on `PATCH`.
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
     * Updates a program's design configuration. Only the fields you send are changed; anything you leave out is untouched (arrays such as `signup.fields` replace wholesale). Unknown fields, fields not available for the program type, and invalid values return a `400`. Landing-page custom code and JavaScript are not editable via the API. To see the full object with every field and its current value, `GET` this resource, then `PATCH` back only the fields you want to change.
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $body partial `CampaignDesign` (see API reference)
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
