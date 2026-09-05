<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type CampaignOptionsShape from \Growsurf\Campaign\CampaignOptions
 * @phpstan-import-type CampaignOptionsUpdateShape from \Growsurf\Campaign\CampaignOptions
 */
interface OptionsContract
{
    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return CampaignOptionsShape
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
     * @param CampaignOptionsUpdateShape $body partial `CampaignOptions` (see API reference)
     * @param RequestOpts|null $requestOptions
     *
     * @return CampaignOptionsShape
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array $body = [],
        RequestOptions|array|null $requestOptions = null,
    ): array;
}
