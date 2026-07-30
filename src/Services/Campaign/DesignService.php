<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\DesignContract;

/**
 * Campaign design (`CampaignDesign`) configuration — the Program Editor's **Design** tab plus payout-destination confirmation page copy.
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
     * Retrieves a program's configured design fields: the dashboard Program Editor's **Design** tab plus the payout-destination confirmation page copy configured from payout integration cards. This includes the GrowSurf window layout, header, share channels and invites, signup form, portal and landing pages, theme styling, and referral or affiliate summary and status sections. The available fields depend on the program type. `payoutDestinationConfirmation` is omitted when no confirmation fields are stored. Stored `null` fields are returned as `null`; omitted and `null` fields use localized defaults.
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
     * Updates a program's design configuration, including the payout-destination confirmation
     * page copy configured from payout integration cards. Only the fields you send are changed;
     * anything you leave out is untouched (arrays such as `signup.fields` replace wholesale).
     * Unknown fields, fields not available for the program type, and invalid values return a
     * `400`. Landing-page custom code and JavaScript are not editable via the API.
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $body partial `CampaignDesign` (for example, `['payoutDestinationConfirmation' => ['headline' => 'Confirm your {{payoutProvider}} payout email']]`)
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
