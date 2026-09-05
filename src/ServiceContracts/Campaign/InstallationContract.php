<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type CampaignInstallationShape from \Growsurf\Campaign\CampaignInstallation
 * @phpstan-import-type CampaignInstallationUpdateShape from \Growsurf\Campaign\CampaignInstallation
 */
interface InstallationContract
{
    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return CampaignInstallationShape
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param CampaignInstallationUpdateShape $body partial `CampaignInstallation` (see API reference)
     * @param RequestOpts|null $requestOptions
     *
     * @return CampaignInstallationShape
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array $body = [],
        RequestOptions|array|null $requestOptions = null,
    ): array;
}
