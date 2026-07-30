<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Conversion\MapOf;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\DesignRawContract;

/**
 * Campaign design (`CampaignDesign`) configuration — the dashboard Program Editor's **Design** tab.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class DesignRawService implements DesignRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves a program's configured design fields: the dashboard Program Editor's **Design** tab plus the payout-destination confirmation page copy configured from payout integration cards. This includes the GrowSurf window layout, header, share channels and invites, signup form, portal and landing pages, theme styling, and referral or affiliate summary and status sections. The available fields depend on the program type. `payoutDestinationConfirmation` is omitted when no confirmation fields are stored. Stored `null` fields are returned as `null`; omitted and `null` fields use localized defaults.
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
            path: ['campaign/%1$s/design', $id],
            options: $requestOptions,
            convert: new MapOf('mixed'),
        );
    }

    /**
     * @api
     *
     * Updates a program's design configuration, including the payout-destination confirmation
     * page copy configured from payout integration cards. Only the fields you send are changed;
     * anything you leave out is untouched (arrays such as `signup.fields` replace wholesale).
     * Unknown fields, fields not available for the program type, and invalid values return a
     * `400`. Landing-page custom code and JavaScript are not editable via the API.
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $body partial `CampaignDesign` (see API reference)
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
            path: ['campaign/%1$s/design', $id],
            body: (object) $body,
            options: $requestOptions,
            convert: new MapOf('mixed'),
        );
    }
}
