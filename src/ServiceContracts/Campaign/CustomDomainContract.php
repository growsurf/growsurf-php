<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Campaign\CampaignCustomDomain;
use Growsurf\Campaign\DeleteCampaignCustomDomainResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface CustomDomainContract
{
    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CampaignCustomDomain;

    /**
     * @api
     *
     * @param string $id path param: GrowSurf program ID
     * @param string $domain body param: The hostname to serve the program's landing pages from, with or without `https://`. Up to 255 characters.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function set(
        string $id,
        string $domain,
        RequestOptions|array|null $requestOptions = null,
    ): CampaignCustomDomain;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function verify(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CampaignCustomDomain;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): DeleteCampaignCustomDomainResponse;
}
