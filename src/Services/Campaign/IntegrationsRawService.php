<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\IntegrationListResponse;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\IntegrationsRawContract;

/**
 * Integration status. Connecting an integration is done in the GrowSurf dashboard.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class IntegrationsRawService implements IntegrationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Lists every integration this program can connect, each with its current state. Integrations that do not apply to the program type are omitted (for example, Wise on a referral program). Read-only: connecting an integration is an OAuth or credential handshake completed in the GrowSurf dashboard, so it cannot be done over the API. `connected` means credentials are stored, `enabled` means the integration is switched on and working, and `autoDisabled` means GrowSurf switched it off after repeated delivery failures — its credentials are still stored, but it delivers nothing until it is reconnected in the dashboard.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IntegrationListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/integrations', $id],
            options: $requestOptions,
            convert: IntegrationListResponse::class,
        );
    }
}
